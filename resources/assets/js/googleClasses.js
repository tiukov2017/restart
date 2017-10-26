/**
 *
 * @param url
 * @param title
 * @param description
 * @param query
 * @param totalCount
 * @param queryFk
 * @constructor
 */
function GoogleResult(url,title,description,query,totalCount,queryFk){
    this.url = url;
    this.title = title;
    this.description = description;
    this.query = query;
    this.totalCount = totalCount;
    this.queryFk = queryFk;
}

/**
 *
 * @param phrase
 * @param url
 * @param id
 * @constructor
 */
function Query(phrase,url,id){
    this.phrase = phrase;
    this.url = url;
    this.id = id;
}
