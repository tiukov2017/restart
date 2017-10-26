(function($){

    var $googleIframeDisabledDomains = ['facebook','plus.google'];
    var currentResultIndex = 1,jsonResults,reportId,token,$iframe,$currentPageIndicator,paginator,total,$prevButton,$nextButton;

    $(document).ready(function () {
         init();
         setPageIndex();
        getDataFromPaginator();
    });


    function init(){
        $prevButton = $('#btn-prev');
        $nextButton = $('#btn-next');
        $iframe = $('#google-results-iframe');
        token = $('meta[name=csrf-token]').attr('content');
        reportId = $('#reportId').val();
        $currentPageIndicator = $('#current-page-indicator');

        $iframe.trigger('locationReload');

        $nextButton.click(getNextPage);
        $('#next-button').attr('title',getNextQuery().phrase);

        $prevButton.click(getPreviousPage);
        $prevButton.css('display','none');
    }

    function getDataFromPaginator(){
        var nextPage = 'search/getNextPage';
        var query = getQuery();
        $.ajax({
            url: '{{ '+nextPage+' }}',
            method: 'get',
            data: {
                'reportId': reportId,
                '_token': token,
                'query': query
            },
            success: updateResultsData
        });
    }

    function updateResultsData(response){
        if(response.data.length == 0){
            showResultsEndPopup();
        }
        else{
            window.localStorage.setItem('paginator',JSON.stringify(response));
            window.localStorage.setItem('googleResults',JSON.stringify(response.data));

            changePage($iframe,response.data,0);

            $('#total-pages-indicator').text(response.total);
        }
    }

    function getPreviousPage(){
        var currentPageCount =  parseInt($currentPageIndicator.text());
        var newPageIndex = currentResultIndex--;

        if(newPageIndex < 0 && currentPageCount != 0 ) {
            currentResultIndex = jsonResults.length-1;
        }

        $('#btn-next').css('display','inline-block');

        if(jsonResults.hasOwnProperty(newPageIndex)) {
            changePage($iframe,jsonResults,newPageIndex);
            setNewPageCount(--currentPageCount);
        }
        else {
            $(document).trigger('prev-page');
            getPreviousPage();
        }
    }

    function getNextPage(){
        var currentPageCount =  parseInt($currentPageIndicator.text());
        var newPageIndex = currentResultIndex;
        total = parseInt($('#total-pages-indicator').text());

        paginator = getPaginator();
        jsonResults = JSON.parse(getResultData());

        if(jsonResults.length != 0){
            $('#btn-prev').css('display','inline-block');

            if(jsonResults.hasOwnProperty(newPageIndex)){
                changePage($iframe, jsonResults,newPageIndex);
                if(currentPageCount < total){
                    setNewPageCount(++currentPageCount);
                }
                currentResultIndex++;
            }
            else{
                currentResultIndex = 0;
                $(document).trigger('next-page');
            }
        }
        else{
           showResultsEndPopup();
        }
    }

    function showResultsEndPopup(){
        var mainParent = window.parent.parent;
        var $acceptButton = $('#redirect-btn');
        var $modal = $('#redirect-popup');
        var message = getErrorMessage();

        attachModal($modal, $acceptButton, message, function () {
            mainParent.$(mainParent.document).trigger('before-redirect');
        });
    }

    function getErrorMessage(){
        return 'אף תוצאה לא נבחרה';
    }

    /**
     * @param newPageCount
     */
    function setNewPageCount(newPageCount){
        if(newPageCount == 0){
            $prevButton.css('display','none');
            currentResultIndex = 1;
        }
        else if(newPageCount == total){
            $nextButton.css('display','none');
            $currentPageIndicator.html(newPageCount);
        }
        else{
            $currentPageIndicator.html(newPageCount);
        }
    }

    /**
     * @param $iframe
     * @param jsonResults
     * @param newPageIndex
     */
    function changePage($iframe,jsonResults,newPageIndex){
        var newPageSrc;

        if(jsonResults.hasOwnProperty(newPageIndex)){
            newPageSrc = replaceComasInUrl(jsonResults[newPageIndex].url);
            changePageSource($iframe,newPageSrc);
            $('#current-url').html(newPageSrc);
        }
    }

    /**
     * @param url
     * @returns {string}
     */
    function replaceComasInUrl(url){
        return url.replaceAll('coma',',');
    }

    function changePageSource($iframe,src){
        $.each($googleIframeDisabledDomains,function(){
          openInNewTab(src,this);
        });
        handleDocFileSources(src,$iframe);
        //Fires event to indicate iframe source changing
        $iframe.trigger('locationReload');
    }

    function openInNewTab(src,domain){
        //In case the domain cannot be framed ,open new browser window popup
        if(src.indexOf(domain)!=-1){
            var width = $iframe.innerWidth();
            var height = 900;
            PopupCenter(src,width,height)
        }
    }

    function handleDocFileSources(src,$iframe){
        if(src.indexOf('.docx')!=-1|| src.indexOf('.doc')!=-1|| src.indexOf('.pdf')!=-1){
            src = "http://docs.google.com/gview?url="+src+"&embedded=true";
            $iframe.attr('src',src);
        }
        else{
            $iframe.attr('src',src);
        }
    }


})(jQuery);
