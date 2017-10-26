//push message and alert class 'alert-danger' or 'alert-success'
$.fn.pushAlert=function(message,alertClass){
    var alert = '<div class="alert '+alertClass+' view-mode-invisible"> ' +
        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+message+'</div>';
    var $alert=$(this).find('.alert');

    if($alert.length!=0){
        $alert.text(message);
    }
    else{
        $(alert).appendTo($(this));
    }
    return $(alert);
};

//params:target window ,selector of the targeted element ,fade out timemeout
$.fn.setFadeOutTimer=function(window,selector,milliseconds){
    var $target = $(selector);

    window.setTimeout(function() {
        $target.fadeTo(1000, 0).fadeOut(500, function(){
            $target.remove();
        });
    }, milliseconds);

};
//Remove html tags if present from string
$.fn.removeHtmlTags=function(string){
  return  string.replace(/(<([^>]+)>)/ig,"").trim();

};

$.fn.scrollToElement=function(){
    var topPosition=this.parent().offset().top-100;
    window.scroll(0,topPosition);

};
//Navigate up/down through elements
$.fn.navigate=function(window){
    var $elements=$(this);
    var topPosition;
    var wordCounter=0;

    $(window.document).focus();
    $(window.document).unbind('keydown');
    $(window.document).on( "keydown", function( event ) {

        switch( event.keyCode ) {

            case $.ui.keyCode.DOWN:
                event.preventDefault();
                (wordCounter<$elements.length-1) ? wordCounter++ : wordCounter=0;
                $($elements[wordCounter]).focus();

                break;

            case $.ui.keyCode.UP:
                event.preventDefault();
                (wordCounter>0) ? wordCounter-- : wordCounter=$elements.length-1;
                $($elements[wordCounter]).focus();

                break;
        }
    });
};

//Replace all occurences of 'search' in string
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search,'g'), replacement);
};

String.prototype.findNumberInString=function(){
    var str = this.replaceAll(',','');
    var regex = /\d+/;

    return str.match(regex);
};

//Get body from stringyfied html
String.prototype.getHtmlBody=function(){
    var body;
    var pattern = /<body[^>]*>((.|[\n\r])*)<\/body>/im;
    var array_matches = pattern.exec(this);

    body = $(array_matches[0]);
    return body;
};
////Resize iframe acording to his content scroll
//function resizeIframe(iframe) {
//    iframe.height = iframe.contentWindow.document.body.scrollHeight+100 + "px";
//}

function resizeIframe(iframe, height){
    iframe.height = height;
}

//Handle ajax errors ,params : js ajax response and jquery element for alert appending
function displayAjaxError(response,errorContainer){

    if(response.responseJSON){
        $.each(response.responseJSON,function(){
            errorContainer.pushAlert(this[0],'alert-danger');

        });
    }
    else{
        errorContainer.pushAlert('ארעה שגיאה!','alert-danger');
    }

}
//action=loading/ready label=element label className=class name to remove while loading
$.fn.changeLoadingStatusIcon=function(action, $label,className) {
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

Element.prototype.isVisible = function(document) {

    'use strict';

    /**
     * Checks if a DOM element is visible. Takes into
     * consideration its parents and overflow.
     *
     * @param (el)      the DOM element to check if is visible
     *
     * These params are optional that are sent in recursively,
     * you typically won't use these:
     *
     * @param (t)       Top corner position number
     * @param (r)       Right corner position number
     * @param (b)       Bottom corner position number
     * @param (l)       Left corner position number
     * @param (w)       Element width number
     * @param (h)       Element height number
     */
    function _isVisible(el, t, r, b, l, w, h) {
        var p = el.parentNode,
            VISIBLE_PADDING = 2;

        if ( !_elementInDocument(el) ) {
            return false;
        }

        //-- Return true for document node
        if ( 9 === p.nodeType ) {
            return true;
        }

        //-- Return false if our element is invisible
        if (
            '0' === _getStyle(el, 'opacity') ||
            'none' === _getStyle(el, 'display') ||
            'hidden' === _getStyle(el, 'visibility')
        ) {
            return false;
        }

        return true;
    }

    //-- Cross browser method to get style properties:
    function _getStyle(el, property) {
        if ( window.getComputedStyle ) {
            return document.defaultView.getComputedStyle(el,null)[property];
        }
        if ( el.currentStyle ) {
            return el.currentStyle[property];
        }
    }

    function _elementInDocument(element) {
        while (element = element.parentNode) {
            if (element == document) {
                return true;
            }
        }
        return false;
    }
    return _isVisible(this);
};

//Create new pseudo selector ,incase sensitive "contains' selector
$.expr[':'].icontains = $.expr.createPseudo(function (text) {
    return function (e) {
        return $(e).text().toUpperCase().indexOf(text.toUpperCase()) >= 0;
    };
});
//Open browser window in popup
function PopupCenter(url, width, height) {
    window.open(url,'_blank');
}

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

