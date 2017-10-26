//Local storage helpers

function clearResults() {
    window.localStorage.removeItem('googleResults');
}
/**
 * @desc Set current result index in google results
 * @param index
 */
function setPageIndex(index){
    var storedIndex = window.localStorage.getItem('pageIndex');
    if( index != undefined ){
        window.localStorage.setItem('pageIndex',index);
    }
    else if(storedIndex == null){
        window.localStorage.setItem('pageIndex',0);
    }
    else {
        storedIndex = parseInt(storedIndex)+10;
        window.localStorage.setItem('pageIndex',storedIndex);
    }
}
/**
 *
 * @param objects
 */
function setQueryObjects(objects){
    window.localStorage.setItem('queries',JSON.stringify(objects));
}

/**
 * @desc Set the query index
 */
function setQueryIndex(index){
    var storedIndex = window.localStorage.getItem('queryIndex');
    if(index != undefined){
        window.localStorage.setItem('queryIndex',index);
    }
    else if(storedIndex != null){
        storedIndex = parseInt(storedIndex)+1;
        window.localStorage.setItem('queryIndex',storedIndex);
    }
    else{
        window.localStorage.setItem('queryIndex',0);
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
 *
 * @returns {int}
 */
function getPageIndex(){
    var pageIndex = window.localStorage.getItem('pageIndex');
    if(pageIndex != null){
        return parseInt(pageIndex);
    }
    else{
        return 0;
    }
}
/**
 *
 * @returns {Array}
 */
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
 * @param queryObjects
 */
function saveQueries(queryObjects){
    var storedQueries;

    storedQueries = JSON.stringify(window.localStorage.getItem('queries'));
    if(storedQueries == 'null' || storedQueries.length < queryObjects.length){
        window.localStorage.setItem('queries',JSON.stringify(queryObjects));
    }
}
/**
 *
 * @returns {Array}
 */
function getResultData(){
    var results = window.localStorage.getItem('googleResults');
    if(results != null){
        return results;
    }
    else{
        return [];
    }
}

function setGoogleResults(googleResults){
   window.localStorage.setItem('googleResults',JSON.stringify(googleResults));
}

function getPaginator(){
    return JSON.parse(window.localStorage.getItem('paginator'));
}

function getQuery(){
    var queryIndex = getQueryIndex();
    var queryObjects = getQueryObjects();
    return queryObjects[queryIndex];
}

function savePaginatorData(response){
    window.localStorage.setItem('paginator',JSON.stringify(response));
    window.localStorage.setItem('googleResults',JSON.stringify(response.data));
    $('#total-pages-indicator').text(response.total);
    $('#btn-next').css('pointer-events','all');
}

function getNextQuery(){
    var queryIndex = getQueryIndex()+1;
    var queryObjects = getQueryObjects();
    return queryObjects[queryIndex];
}

function attachModal($modal,$actionButton,message,actionFunction){
    $modal.find('.modal-body').html(message);
    $actionButton.unbind('click');
    $actionButton.on('click',actionFunction);
    $modal.modal('show');
}

