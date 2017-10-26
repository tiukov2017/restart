(function() {
    var $iframe,$keywords, $iframeContents, $keywordsDropdown, $keywordsButton, $targetIframe, $keywordsCountLabel,$reportKeywords;
    $(document).ready(function () {

        init();
        //Repeat keywords search action
        $('.glyphicon-repeat').on('click', function () {

            event.stopPropagation();

            var $repeat = $('.glyphicon-repeat');

            $keywordsDropdown.changeLoadingStatusIcon('loading',$repeat,'glyphicon-repeat');
            //Timeout added just for refresh animation effect
            window.setTimeout(function(){
                $iframeContents = $iframe.contents();
                unmarkAll($iframeContents,$keywords);
                countKeywords($keywords, $iframeContents, 'badge', $keywordsButton);
                $keywordsDropdown.changeLoadingStatusIcon('ready',$repeat,'glyphicon glyphicon-repeat');

            },1000);
        });
        //Event fires when navigating beetween pages of google
        $iframe.on('locationReload', searchForKeyWords);
    });

    function searchForKeyWords(){
        $keywordsDropdown.changeLoadingStatusIcon('loading',$keywordsCountLabel,'badge');
        //Need to set interval because it's impossible to detect if iframe's document is ready
        var checkGoogleIframeInterval = setInterval(function () {
            try {

                $iframeContents = $iframe.contents();

                if($iframeContents != []){
                    clearInterval(checkGoogleIframeInterval);
                    $keywords = $keywordsDropdown.find('li');
                    countKeywords($keywords, $iframeContents, 'badge', $keywordsButton);
                    $keywordsDropdown.changeLoadingStatusIcon('ready',$keywordsCountLabel,'');
                }
            }
            catch (err) {
                $keywordsButton.find('.keywords-count').addClass('badge').
                    text('0').changeLoadingStatusIcon('ready',$keywordsCountLabel,'badge');
                clearInterval(checkGoogleIframeInterval);
            }
        }, 5000);
    }


    function init() {

        $iframe = $('#google-results-iframe');
        $targetIframe = $(window.parent.document).find('#editor-report-iframe');
        $reportKeywords=getKeywordsArrFromIframe($targetIframe,'keyword');
        $keywordsDropdown = $('#keywords');
        $keywordsCountLabel = $keywordsDropdown.find('.keywords-count');
        $keywordsButton = $keywordsDropdown.find('.dropdown-toggle');

        var checkGoogleIframeInterval = setInterval(function () {
            fillKeywords($keywordsDropdown.find('ul'),$reportKeywords);
            clearInterval(checkGoogleIframeInterval);
        },5000);
    }


   //Unmark all marked keywords in iframe
    function unmarkAll($iframeContents,$kewords){

        $.each($kewords,function(){
            var keyword = $(this).find('a').text().trim().toString();
            $iframeContents.find('body').unmark(keyword);
        });
    }
    //Search the iframe and count the keywords
    function countKeywords($keywords, $iframeContents, keywordLabelClassName, $keywordsButton) {
        var totalKeywordsFound = 0;
        var $keywordOccurences=[];

        $.each($keywords,function(){
            var $keywordItem=$(this);
             var keyword = $(this).find('a').text().trim().toString();

            $iframeContents.find('html').mark(keyword,{
                done: function (totalMatches) {
                    $keywordItem.find('.' + keywordLabelClassName).text(totalMatches);
                    totalKeywordsFound += totalMatches;
                    $keywordItem.unbind('click').click(function(){
                        navigateKeywords($keywordOccurences,$iframeContents,keyword)
                    });
                },
                noMatch:function(keyword){
                    console.log('not found');
                },
                each:function(keyword){
                         if(!isHidden(keyword)){
                             $keywordOccurences.push(keyword);
                         }
                },
                'exclude':['meta','title','img','input'],
                'separateWordSearch':false,
                'accurancy':'exactly'
            });
        });
        $keywordsButton.find('.keywords-count').addClass(keywordLabelClassName).
            text(totalKeywordsFound);
    }

    //Keywords navigation script with 'up' 'down' keys
    function navigateKeywords($keywordOccurences,keyword){
        var iframeWindow=$(window.document).contents().find('#google-results-iframe')[0].contentWindow;
        $($keywordOccurences).navigate(keyword,iframeWindow);
    }

    //Fill the related $keywordsDropdown in $targetIframe with keywords defined by the attribute
    function fillKeywords($keywordsDropdown,$keywordsArr) {
        $.each($keywordsArr,function(){
           var keywords = keywordsArrStr($keywordsDropdown);
                var keyword = '<li><span class="badge"></span><a htef="#">' + this + '</a></li>';

            if($.inArray(this.toString(),keywords)==-1){
                $(keyword).appendTo($keywordsDropdown);
            }
        });
    }
   //Get keywords from dropdown element
   function keywordsArrStr($keywordsDropdown){
       var keywordsStrArr=[];

       $keywordsDropdown.find('li').each(function(){
           var keyword = $(this).find('a').text().trim();
           keywordsStrArr.push(keyword);
       });
       return keywordsStrArr;
   }
    //Get keywords from report iframe,from inputs with attribute param=attribute
    function getKeywordsArrFromIframe($targetIframe,attribute){
        var $inputs = $targetIframe.contents().find('[' + attribute + ']');
        var $keywordsArr=[];

        $inputs.each(function () {
            if ($(this).val() != '' && $(this).val() != 'undefined') {
                var keyword = $(this).val().trim();
                $keywordsArr.push(keyword);
            }
    });
        return $keywordsArr;
    }

    $.fn.scrollToElement=function(window){
        var topPosition=this.offset().top+100;
        var leftPosition=this.offset().left;

        $(window.document).find('.check-container').scrollTop(topPosition);
    };

//Navigate through all occurences of keyword in iframe
    $.fn.navigate=function(keyword,window){

        var $elements=$(this);
        var wordCounter=0;

        $($elements[0]).attr('style','background-color:orange');
        $($elements[0]).scrollToElement(window.top);

        window.focus();

        $(window.document).on( "keydown", function( event ) {
            switch( event.keyCode ) {

                case $.ui.keyCode.DOWN:
                    event.preventDefault();
                    $($elements[wordCounter]).removeAttr('style');
                    (wordCounter<$elements.length-1) ? wordCounter++ : wordCounter=0;
                    $($elements[wordCounter]).attr('style','background-color:orange');
                    $($elements[wordCounter]).scrollToElement(window.top);

                    break;
                case $.ui.keyCode.UP:
                    event.preventDefault();
                    $($elements[wordCounter]).removeAttr('style');
                    (wordCounter>0) ? wordCounter-- : wordCounter=$elements.length-1;
                    $($elements[wordCounter]).attr('style','background-color:orange');
                    $($elements[wordCounter]).scrollToElement(window.top);

                    break;
            }
        });
    };
//action=loading/ready label=element label className=class name to remove while loading
    $.fn.changeLoadingStatusIcon = function(action, $label,className) {
        if(action=='loading'){
            $label.removeClass(className).text('').addClass('glyphicon glyphicon-refresh glyphicon-refresh-animate');
            $(this).addClass('disabled');
        }
        else{
            $label.removeClass('glyphicon glyphicon-refresh glyphicon-refresh-animate');
            $label.addClass(className);
            $(this).removeClass('disabled');
        }
    };

    //Where el is the DOM element you'd like to test for visibility
    function isHidden(el) {
        return (el.offsetParent === null)
    }
})(jQuery);
