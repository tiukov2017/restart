(function($){

    var REPORT_ID;

    var TOKEN;

    var ADD_PATH = '{{ editor/addbookmark }}';

    var REMOVE_PATH = '{{ editor/removebookmark }}';

    var $addBookmarkBtn;

    $(document).ready(function () {

        REPORT_ID = $('#reportId').val();

        TOKEN =  $('[name="_token"]').val();

        $addBookmarkBtn =  $('.add-bookmark');

        $addBookmarkBtn.tooltip({trigger: "hover"});

        $addBookmarkBtn.on('click', showAddBookmarkForm);

        $('#add-bookmark-btn').on('click',addBookmark);

        $(document).on('click','.remove-bookmark',removeBookmark);

        var $cachedBookmarks = checkLocalStorageForBookmarks();

        var $bookmarksFromServer = $('.bookmarks-dropdown').find('li');

        if($cachedBookmarks.length!=0){

            var $mergedBookmarks = $.merge($bookmarksFromServer,$cachedBookmarks);

            if($.unique($mergedBookmarks).length!=$bookmarksFromServer.length) {

                addBookmarksFromList($cachedBookmarks);

            }

            cleanCachedBookmarks();
        }
    });

    function checkLocalStorageForBookmarks(){

        return $(localStorage.getItem('bookmarks'));
    }

    function addBookmarksFromList($bookmarks){

        $bookmarks.each(function(){

            $(this).appendTo($('.bookmarks-dropdown'));

        });
    }

    function cleanCachedBookmarks(){

        localStorage.removeItem('bookmarks')
    }

    function showAddBookmarkForm(event){

         event.stopPropagation();

        var $form = $('.add-bookmark-form');

        $('#readlist').find('.dropdown-toggle').dropdown('toggle');

        $form.find('#add-bookmark-title').val('');

        $form.css('display','flex');

        $addBookmarkBtn.on('click',function(event){

            event.stopPropagation();

            $('.add-bookmark-form').css('display','none');

            $addBookmarkBtn.unbind('click');

            $addBookmarkBtn.on('click',showAddBookmarkForm);

        });
    }

    function addBookmark(){

        var googleResultsIframe = $('#google-results-iframe')[0];

        var bookmark_url =googleResultsIframe.contentWindow.location.href;

        bookmark_url = filterAuthQueryString('linkedin',bookmark_url,googleResultsIframe);

        var bookmark_title = $('#add-bookmark-title').val() || bookmark_url ;

        $.ajax({

        url : ADD_PATH,

        method : 'POST',

        data :  {title:bookmark_title,url:bookmark_url,report_id:REPORT_ID,_token:TOKEN}

        }).success(function(response){

            var $elm = createNewBookmarkListItem(response.id,response.url,response.title);

            $elm.appendTo($('.bookmarks-dropdown'));

            $addBookmarkBtn.click();

        });
    }

    function filterAuthQueryString(domainName,url,iframe){

        var domain =  iframe.contentWindow.location.hostname;

        if(domain.indexOf(domainName)>-1){

           if(url.indexOf('?')>-1){

               url =url.substr(0,url.indexOf('?'));
           }
        }
        return url;
    }

    function createNewBookmarkListItem(id,url,title){

        var elm = '<li><i class="fa fa-trash remove-bookmark" data-id="'+id+'" aria-hidden="true"></i><a href="'+url+'" data-toggle="tooltip" title='+title+' target="google-results-iframe">'+title+'</a></li>';

        insertBookmarkIntoLocalStorage(elm);

        return $(elm);
    }

    function insertBookmarkIntoLocalStorage(bookmark){

        var bookmarks = localStorage.getItem('bookmarks');

        bookmarks = bookmarks!=null ? bookmarks + bookmark : bookmark;

        localStorage.setItem('bookmarks',bookmarks);
    }

    function removeBookmark(event){

        event.stopPropagation();

        var $element = $(this).closest('li');

        var id = $(this).data('id');

        $.ajax({

            url : REMOVE_PATH,

            method : 'POST',

            data :  {id:id,_token:TOKEN}

        }).success(function(){

           $element.remove();

        });

    }
})(jQuery);
