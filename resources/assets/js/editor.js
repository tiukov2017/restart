var REPORT_ID;
var TOKEN;

(function($){

    var $reportIframe,$checkContainer,$parent,$reportContainer,$checkIframe;

    var reportEditTime = new Date();

    var reportEditExpiryTime = new Date(reportEditTime.getTime()+180*60000);

    window.onbeforeunload=function() {

        unlockReport();
    };

    $(document).ready(function(){

        var reportIframeReady,checkIframeReady,checkContainerHeight,targetWidth=0;

        var  $parent=$('.editor-iframes');

        var path = window.location.pathname;

        REPORT_ID = path.substring(path.lastIndexOf('/')+1);

        TOKEN = $('meta[name="csrf-token"]').attr('content');

        checkContainerHeight = $('.check-container').height();

        reportIframeReady = $.Deferred();

        checkIframeReady   = $.Deferred();

        var whenBoth = $.when(reportIframeReady, checkIframeReady);

        $('#editor-report-iframe').css('height',checkContainerHeight-152);

        //Expand container
        $('.expand').on('click',function(){

            var fullWidth = parseInt($('#editor').css('width'))-50;

            var $target = $(this).closest('.expandable-container');

            $target.find('iframe').removeAttr('style');

            targetWidth =$target.width();

            var $targetsSibling = $target.siblings('.expandable-container');

            $target.animate({width:fullWidth},1000);

            $targetsSibling.css('display','none');

            $(this).css('display','none');

            $target.find('.compress').css('display','block');

        });
        //Compress container
        $('.compress').on('click',function(){

            var $target = $(this).closest('.expandable-container');

            var $targetsSibling = $target.siblings('.expandable-container');

            $target.animate({width:targetWidth},1000,function(){ $targetsSibling.css('display','block');});

            $(this).css('display','none');

            $target.find('.expand').css('display','block');
        });
        //Handle report resize event
        $(document).bind('report-resize',function(){

           $checkContainer=$('.check-container');

           $reportContainer=$('#editor-report-iframe');

            $('.report-container').css('width',$reportContainer.css('width'));

           resizeBrother($parent,$reportContainer,$checkContainer);

       });

        //Prevent losing data when redirecting from google
        $(document).on('before-redirect',function(){

            $reportIframe=$('#editor-report-iframe');
            //Trigger report save event
            $reportIframe.contents().find('#saveBTN').trigger('click');
        });
        //Event is triggered to detect when report fully loaded
        $(document).on('report-ready', function(){

            $reportIframe=$('#editor-report-iframe');

            $checkIframe = $('#editor-check-iframe');

            var checkNumber = $checkIframe.data('current-check');

            $reportIframe[0].contentWindow.$( $reportIframe[0].contentWindow.document).trigger('check-ready',[checkNumber]);

            var src =  $reportIframe.attr('src');

            REPORT_ID = src.substring(src.lastIndexOf('/')+1);

            reportIframeReady.resolve();

        });
        //When check iframe is ready
        $(document).bind('check-ready', function(){

            checkIframeReady.resolve();

            whenBoth.then(function(){

               var $checkIframe = $('#editor-check-iframe');

               var $reportIframe=$('#editor-report-iframe');

                $checkIframe.contents().find('#reportId').val(REPORT_ID);

                generateQueries( $checkIframe,$reportIframe)

            });
        });

        window.setInterval(lockReport,30*1000);

    });

    //Generate google queries for each query in3.0ut from report data and query template
    function generateQueries(checkIframe,$reportIframe){

        var $inputs=checkIframe.contents().find(".generated-query-input");

        $.each($inputs, function () {

           var $params = $(this).data('params');
            //Id's of input elements from report
            var idsArr= $(this).data('ids').split(',');

            $.each(idsArr,function(index,value){
                //This represents the value that will be replaced in the query template
                var indexValue=index;

                var elementValue=$reportIframe.contents().find('#'+value).val();

                if(elementValue!=""){
                    //Replace all parameter occurences(p1,p2,p3 see queries structure in q) by the element value
                    var regex = '(")(p' + indexValue + ')[\\s]|(p'+indexValue+')(")|(")(p'+indexValue+')(")';

                    $params = $params.replaceAll(regex,elementValue+" ");
                }
            });
            $params = '"'+$params.trim()+'"';
            //Check if the query still has not rplaced parameters ,means ,matching input from report was not present
            if($params.match(/(")p[0-9]+|p[0-9]+(")|(")p[0-9]+(")/)){
              $(this).closest('.form-group').remove();
            }
            $(this).val($params);
        });
    }
    //Resize brother element of the resized element
    function resizeBrother($parent,$resizedElement,$brother){

        var width=$resizedElement.width()+20;

        var parentWidth=$parent.width();

        var checkContainerwidth=parentWidth-width;

        $brother.width(parentWidth-width);

        if(checkContainerwidth<400){
            $brother.css('display','none');
        }
        else{
            $brother.css('display','inline-block');
        }
    }
    function unlockReport(){

        $.ajax({

            url: '{{ report/unlock }}',
            method:'post',
            data :{id:REPORT_ID,_token:TOKEN}
        }).success(function(){


        }).error(function(){

        });
    }

    function lockReport(){

        if(new Date().getTime()<reportEditExpiryTime.getTime()){

            $.ajax({

                url: '{{ report/lock }}',
                method:'post',
                data :{id:REPORT_ID,_token:TOKEN}
            }).success(function(){


            }).error(function(err){
                // window.location.reload();
            });
        }
        else{
            unlockReport();
            $(window.document).trigger('before-redirect');
            window.location.href ='{{  }}'
        }
    }

})(jQuery);
