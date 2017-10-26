var localService = (function($){

    function setGoogleResults(googleResults){
        var results =  JSON.parse(window.localStorage.getItem('googleResults'));
        var merged = [];
        if(results !=null){
            merged = results.concat(googleResults);
            window.localStorage.setItem('googleResults',JSON.stringify(merged));
        }
        else{
            window.localStorage.setItem('googleResults',JSON.stringify(googleResults));
        }
    }

    function getResultData(){
        var results = window.localStorage.getItem('googleResults');
        if(results !=null){
            return results;
        }
        else{
            return [];
        }
    }

    function getQueryObjects(){
        var queries = window.localStorage.getItem('queries');

        if(queries != null){
            return JSON.parse(queries);
        }
        else{
            return [];
        }
    }

    /**
     *
     * @param queryObjects
     */
    function saveQueries(queryObjects){
        var storedQueries;

        storedQueries = window.localStorage.getItem('queries');
        if(!storedQueries){
            window.localStorage.setItem('queries',JSON.stringify(queryObjects));
        }
        else{
            storedQueries = JSON.parse(storedQueries).concat(queryObjects);
            window.localStorage.setItem('queries',JSON.stringify(storedQueries));
        }
    }

    /**
     * @desc Get the current query index
     * @returns {int}
     */
    function getQueryIndex(){
        var index = window.localStorage.getItem('queryIndex');

        if(index != null){
            return parseInt(index);
        }
        else{
            return 0;
        }
    }

    /**
     * @desc Set the query index
     */
    function setQueryIndex(){
        var storedIndex = window.localStorage.getItem('queryIndex');
        if(storedIndex != null){
            storedIndex = parseInt(storedIndex)+1;
            window.localStorage.setItem('queryIndex',storedIndex);
        }
        else{
            window.localStorage.setItem('queryIndex',1);
        }
    }

    /**
     * @desc Set current result index in google results
     * @param index
     */
    function setPageIndex(index){
        var storedIndex = window.localStorage.getItem('pageIndex');

        if(index){
            window.localStorage.setItem('pageIndex',0);
        }
        else if(storedIndex != null){
            storedIndex = parseInt(storedIndex)+10;
            window.localStorage.setItem('pageIndex',storedIndex);
        }
        else{
            window.localStorage.setItem('pageIndex',10);
        }
    }

    function setQueryObjects(objects){
        window.localStorage.setItem('queries',JSON.stringify(objects));
    }

    function clearResults(){
        window.localStorage.removeItem('googleResults');
    }

    function getPageIndex(){
        var pageIndex = window.localStorage.getItem('pageIndex');
        if(pageIndex != null){
            return parseInt(pageIndex);
        }
        else{
            return 0;
        }
    }



})(jQuery);