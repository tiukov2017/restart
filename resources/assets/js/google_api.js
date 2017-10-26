(function($){
    var googleIsReady,whenGoogleReady,googleResultsReady,whenResultsAreReady,token,reportId,queryObjects=[];

    $(document).ready(function () {
        token = $('meta[name=csrf-token]').attr('content');
        reportId = $('#reportId').val();

        initHandlers();
    });

    function initHandlers(){
        bindNextPageEvent();
        bindPreviousPageEvent();

        $('.pagination .disabled').removeClass('disabled');

        //Handle results preview page view results button
        $(document).on('click', '#view-results',startNewSearch);

        //Handle preview button on main queries page
        $(document).on('click','#google-preview-button',function(event){
            event.preventDefault();
            setQueryIndex(0);
            getFirstPage()
        });

        $('#next-page').on('click',function(){
            clearResults();
            nextPage(function(){getPreviewPaginator(redirectToNextPage)});
        });

        //Handle results viewer next query button
        $('#next-button').on('click',function (event) {nextQuery(event,redirectToPageByPageView)});

        //Handle search refresh on preview page
        $('#new-search').on('click',handleQueryChange);

        //Handle next query button on preview page
        $('#next-query-preview').on('click',function(event){
            nextQuery(event,redirectToResults);});

        //Handle pagination on preview page
        $('.pagination li').on('click',getNextPageFromServer);

        $('#filtered-results-table').on('click',redirectToFilteredResultsTable);
    }

    function bindNextPageEvent(){
        //Handle next-page event
        $(document).on('next-page',function(){
            $('#btn-next').css('pointer-events','none');
            getNextPageFromPaginator();
        });
    }

    function bindPreviousPageEvent(){
        //Handle prev-page event
        $(document).on('prev-page',function(){
            bindNextPageEvent();
            getPreviousPageFromPaginator();
        });
    }

    function getFirstPage(){
        setPageIndex(0);
        getNextGoogleResults(getSecondPage);
    }
    function getSecondPage(){
        setPageIndex(10);
        getNextGoogleResults(redirectToResults);
    }

    function getPreviewPaginator(callback){
        var query = getQuery().phrase;
        var url = 'search/preview/paginate/'+ reportId +'/'+ query;
        $.ajax({
            url:  '{{ '+url+' }}',
            method:'get'
        }).done(callback);
    }

    function redirectToNextPage(paginator){
        var query = getQuery().phrase;
        if(paginator.last_page == 1){
            alert('אין יותר תוצאות חדשות מגוגל');
            $('#next-page').css('display','none');
        }
        else{
            var url = 'search/preview/results/'+ reportId +'/'+ query +'?page=2';
            window.location.href = '{{ '+url+' }}'
        }
    }

    function getNextPageFromServer(event){
        event.preventDefault();
        var nextPageHref = $(this).attr('href') || $(this).find('a').attr('href');
        if(nextPageHref == undefined){
            nextPageHref = window.localStorage.getItem('current-page');
        }
        window.localStorage.setItem('current-page',nextPageHref);
        nextPage(function(){redirectToResults(nextPageHref)});
    }

    function redirectToFilteredResultsTable(event){
        event.preventDefault();
        var query = getQuery().phrase;
        var url = 'filteredGoogleResultsByQuery/'+reportId+'/'+query ;
        window.location.href = '{{ '+url+' }}';
    }

    function nextQuery(event,callback){
        event.preventDefault();
        if(getQueryIndex()+1 < getQueryObjects().length){
            clearResults();
            setPageIndex(0);
            setQueryIndex();
            getNextGoogleResults(callback);
        }
        else{
            alert('אין יותר שאילתות להרצה')
        }
    }

    function nextPage(callback){
        setPageIndex();
        getNextGoogleResults(callback)
    }

    function handleQueryChange(event){
        event.preventDefault();
        var newQuery = $('.query-input').val();
        var queryIndex = getQueryIndex();
        setPageIndex(0);

        clearResults();
        updateQuery(newQuery,queryIndex);
        getFirstPage();
    }

    function startNewSearch(event){
        event.preventDefault();
        clearResults();
        getNextGoogleResults(redirectToPageByPageView)
    }

    function updateQuery(newValue,queryIndex){
        var queries = getQueryObjects();
        var query = queries[queryIndex];

        query.phrase = newValue;
        query.url =  generateGoogleQuery(newValue);
        setQueryObjects(queries);
    }

    function getNextGoogleResults(callback){
        var pageIndex = getPageIndex();
        initDeferredObjects();

        callGoogle(parseInt(pageIndex));
        whenGoogleReady.then(function(){
            saveResultData(callback)
        });
    }

    function initDeferredObjects(){
        googleIsReady = $.Deferred();
        googleResultsReady =  $.Deferred();
        whenGoogleReady = $.when(googleIsReady);
        whenResultsAreReady = $.when(googleResultsReady);
    }

    /**
     *@desc google call
     */
    function callGoogle(startIndex){
        var query;
        updateAllReportQueries('#google-form input');
        generateQueriesForGoogle();
        query = getQuery();
        performGoogleSearch(query,startIndex);

        whenResultsAreReady.then(function(){
            googleIsReady.resolve();
        });
    }

    function generateQueriesForGoogle(){
        var $queries = $('.query-input');
        var queriesArr=[];

        $queries.each(function(){
            var queryObject;
            var query = $(this).val();
            var queryId = $(this).data('query-id');

            if(query !='""' && query!='' && query != undefined){
                $(this).val(query.replace(" ","+"));
                var googleQuery = generateGoogleQuery($(this).val());

                queriesArr.push(googleQuery);
                queryObject = new Query(query,googleQuery,queryId);
                queryObjects.push(queryObject);
            }
        });
        saveQueries(queryObjects);
        $('#queriesArr').val(queriesArr.toString());
    }


    function generateGoogleQuery(queryPhrase){
        return "https://www.google.co.il/search?site=webhp&sourceid=chrome-psyapi2&ion=1&espv=" +
            "2&aqs=chrome.0.69i59j69i60l3j69i57j69i59.12774j0j8&ie=UTF-8&q="+queryPhrase;
    }


    function saveResultData(success){
        var queryObjects = getQueryObjects();
        reportId = $('#reportId').val();
        token = $('meta[name=csrf-token]').attr('content');
        console.log('attempting to save google results');
        $.ajax({
            method: 'post',
            url: '{{ search/preview/save }}',
            data:{
                'googleResults': JSON.stringify(getResultData()) ,
                'query':queryObjects[getQueryIndex()] ,
                'queries':queryObjects ,reportId: reportId ,
                _token: token
            },
            error: handleError
        }).done(success);

        function handleError(response){
            console.log(response);
        }
    }

    function performGoogleSearch(query,startIndex){
        var googleQuery = query.url +'&start='+startIndex;

            $.ajax({
                method:'get',
                url: googleQuery,
                error: handleError
            }).done(parseGoogleResponse);

        function parseGoogleResponse(response){
            var googleBody,googleResults;
            googleBody = response.getHtmlBody();
            googleResults = getGoogleResultsArray(googleBody,query);
            setGoogleResults(googleResults);

            googleResultsReady.resolve()
        }

        function handleError(response) {
            if (response.status == 503) {
                var parentDocument = window.parent.document;
                var mainParent = window.parent.parent;
                var $iframe = $(parentDocument).find('#editor-check-iframe');
                var $acceptButton = $('#redirect-btn');
                var $modal = $('#redirect-popup');
                var message = getErrorMessage();
                var pageIndex = getPageIndex();
                setPageIndex(pageIndex-1);

                attachModal($modal, $acceptButton, message, function () {
                    mainParent.$(mainParent.document).trigger('before-redirect');
                    $iframe.attr('src', 'https://www.google.co.il/?gws_rd=ssl');
                });
                console.log(response);
            }
        }

        function getErrorMessage(){
            return "ארעה שגיאה בנמוע החיפוש ,בלחיצה על המשך הדוח הנוכחי ישמר ותועבר להמשך החיפוש בגוגל";
        }
    }

    function redirectToPageByPageView(){
        $.ajax({
            url: '{{ search }}',
            method: 'post',
            data:
            {
                'googleResults': JSON.stringify(getResultData()),
                'queries': JSON.stringify(getQueryObjects()),
                'currentQueryIndex': getQueryIndex() ,
                '_token': token,
                'reportId': reportId
            },
            success:function(response){
                window.location.href = response;
            }
        });
    }

    /**
     * @desc Parse google results of single page from google
     * @param body
     * @param query
     * @returns {Array} array of GoogleResults objects
     */
    function getGoogleResultsArray(body,query){
        var googleResultsArray = [];
        var count = countGoogleResults(body);

        if(!resultsNotFound(body)){
            body.find('.g').each(function(){
                var googleResult,$resultTitleElement;
                $resultTitleElement = $(this).find('.r ');
                if($resultTitleElement.length > 0) {
                    googleResult = generateGoogleResultFromHtmlResponse.apply(this,[$resultTitleElement,query,count]);
                    googleResultsArray.push(googleResult);
                }
            });
        }
        return googleResultsArray;
    }

    function generateGoogleResultFromHtmlResponse($resultTitleElement,query,count){
        var url,title,description;
            url = $resultTitleElement.find('a').data('href')|| $resultTitleElement.find('a').attr('href');
            title = $resultTitleElement.find('a').text();
            description = $(this).find('.s .st').text();
            url = url.replaceAll(',','coma');

        return new GoogleResult(url,title,description,query.phrase,count,query.id);
    }


    function resultsNotFound(body){
        var $topMessage = body.find('#topstuff');
        var resultsNotFound = false;

         $topMessage.find('.med').each(function () {
             var message = $(this).text().trim();
            resultsNotFound = (message.indexOf('לא נמצאו תוצאות עבור') != -1 || message.indexOf('No results found') != -1);
         });
        return resultsNotFound ;
    }

    /**
     * @desc Get google results number from google response body
     * @param body
     * @returns {string} google results number
     */
    function countGoogleResults(body){
        return body.find('#resultStats').text();
    }
    /**
     * Update all report queries
     */
    function updateAllReportQueries(selector) {
        var inputs = $(selector);

        inputs.each(function() {
            var query = $(this).val();
            var queryId =  $(this).data('query-id');
            updateReportQuery(queryId, query);
        });
    }

    function updateReportQuery(queryId, query) {
        var updateData = {
            reportId: reportId,
            queryId: queryId,
            token: token,
            name: query
        };
        googleApiService.updateReportQuery(updateData);
    }

    function getDataFromPaginator(nextPage){
        if(nextPage == null ){
           nextPage = '{{ search/getNextPage }}'
        }
        var query = getQuery();
        $.ajax({
            url: nextPage,
            method: 'get',
            data: {
                'reportId': reportId,
                '_token': token,
                'query': query
            },
            success: updateResultsData
        });
    }

    function getPreviousPageFromPaginator(){
        var prevPage = getPaginator().prev_page_url;
        if(prevPage != null){
            getDataFromPaginator(prevPage);
        }
    }

    function getNextPageFromPaginator(){
        var nextPage = getPaginator().next_page_url;
        getDataFromPaginator(nextPage);
    }

    function updateResultsData(response){
        if(response.current_page == response.last_page){
            $(document).unbind('next_page');
        }
        savePaginatorData(response);
    }

    function redirectToResults(response){
        console.log('Redirecting to page'+ response);
        window.location.href = response;
    }

})(jQuery);

//# sourceMappingURL=google_api.js.map
