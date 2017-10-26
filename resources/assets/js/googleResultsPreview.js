(function ($) {
    var token;
    var reportId;
    var page = 1;

    $(document).ready(function () {
        token = $('meta[name=csrf-token]').attr('content');
        reportId = $('#reportId').val();
        $('.switch input').on('click', toggleResultFiltering);
        $('.save-summary').on('click', updateResult);
        $('#switch-all').on('click', filterAll);
        $('#save-query').on('click', saveQuery);
    });

    /**
     * @desc toggle all page results state on/off
     * @param event
     */
    function filterAll(event) {
        var dataToggle = $(event.target).data('on');
        $('.switch').each(function () {
            $(this).find('[data-on = ' + dataToggle + ']').click();
        });
    }

    function updateResult() {
        var $floppyIcon = $(this);
        var googleResult = new GoogleResult();
        var $summary = $(this).closest('.summary');

        $floppyIcon.changeLoadingStatusIcon('loading', $floppyIcon, 'badge');

        googleResult.id = $summary.data('result-id');
        googleResult.reportId = $('#reportId').val();
        googleResult._token = token;
        googleResult.user_comments = $summary.find('textarea').val();

        $.ajax({
            url: '{{ filteredGoogleResults/updateResultSummary }}',
            method: 'post',
            data: googleResult
        }).done(function () {
            $floppyIcon.changeLoadingStatusIcon('ready', $floppyIcon, 'fa-floppy-o');
        });
    }

    function toggleResultFiltering() {
        var resultId = $(this).closest('.switch').data('result-id');
        var checked = $(this).data('on');

        if (!checked) {
            removeResult(resultId);
        }
        else {
            restoreResult(resultId);
        }
    }

    function removeResult(resultId) {

        $.ajax({
            url: '{{ search/preview/removeResult }}',
            method: 'post',
            data: {'resultId': resultId, _token: token}
        }).done(function () {
            getPreviewPaginator(checkPaginator);
        });
    }

    function restoreResult(resultId) {
        $.ajax({
            url: '{{ search/preview/restoreResult }}',
            method: 'post',
            data: {'resultId': resultId, _token: token}
        }).done(function () {
            getPreviewPaginator(checkPaginator);
        });
    }

    function getPreviewPaginator(callback) {
        var query = getQuery().phrase;
        page = getQueryString('page');
        var url = 'search/preview/paginate/' + reportId + '/' + query +'?page='+page;
        $.ajax({
            url: '{{ '+url+' }}',
            method: 'get'
        }).done(callback);
    }

    function getQueryString( field, url ) {
        var href = url ? url : window.location.href;
        var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
        var string = reg.exec(href);
        return string ? string[1] : null;
    }

    function checkPaginator(paginator) {
        var $pageLinks = $('.pagination').find('li');
        var totalPages = $pageLinks.length - 2;
        var $nextButton = $pageLinks[totalPages + 1];
        var query = getQuery().phrase;
        var $lastPageLink;
        var newNextLink;

        if (paginator.last_page < totalPages) {
            $lastPageLink = $pageLinks[totalPages];
            newNextLink = 'search/preview/results/' + reportId + '/' + query + '?page=' + paginator.current_page;
            $lastPageLink.remove();
            $($nextButton).find('a').attr('href', ' {{ '+newNextLink+' }}');
        }
    }

    function saveQuery() {
        var query = $('[data-query-id]').val();
        var queryId = $(this).data('query-id');

        if (queryId != 0) {
            updateExistingQuery(queryId, query);
        }
        else {
            createQuery(query);
        }
    }

    function updateExistingQuery(queryId, query) {
        var updateData = {
            reportId: reportId,
            queryId: queryId,
            token: token,
            name: query
        };
        googleApiService.updateReportQuery(updateData);
    }

    function createQuery(query) {
        var updateData = {
            reportId: reportId,
            token: token,
            name: query
        };
        googleApiService.createReportQuery(updateData);
    }


})(jQuery);

