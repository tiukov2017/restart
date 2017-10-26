(function($){

    var TOKEN = $('meta[name="csrf-token"]').attr('content');

    var REPORT_ID;

    var targetIframe;

    $(document).ready(function () {

        var path = window.location.pathname;

        REPORT_ID = path.substring(path.lastIndexOf('/')+1);

        $(document).bind('screenshot',function(event,target){

            var currentReference = JSON.parse(localStorage.currentReference);

            saveReference(currentReference,target);

        });
        //Handle paste event anywhere in document
        $(document).bind('paste',function(event,targetDocument,$target,json){

            var $editorCheckIframe = $('#editor-check-iframe');

            var googleIframe = $editorCheckIframe.contents().find('#google-results-iframe');

            targetIframe = googleIframe.length == 0 ? $editorCheckIframe[0] : googleIframe[0];

            addReferenceTostorage(json,targetIframe);

        });
         //Save reference attributes to local storage
        function addReferenceTostorage(json,targetIframe){

            var header = json.header;

            var category = json.category;

            var sourceUrl =targetIframe.contentWindow.location.href;

            var reference = {header:header,category:category,reference_url:sourceUrl};

            localStorage.setItem('currentReference',JSON.stringify(reference));
        }

        //Send Reference to server
        function saveReference(reference,target){

            var $element = target;

            $.ajax({
                url: '{{ editor/savereferences }}',
                method:'post',
                data: {reference : reference,id:REPORT_ID,_token:TOKEN}

            }).success(function(){

              var $alert = $element.pushAlert('הסימוכין והדוח נשמרו בהצלחה','alert-success')

                    $alert.setFadeOutTimer($('#editor-report-iframe')[0].contentWindow,'.alert-success',3000);

                localStorage.removeItem('currentReference');

            }).error(function(){

              $element.pushAlert('ארעה בעיה בשמירה ,נא לנסות שוב.','alert-danger')

            });
        }

    });
})(jQuery);