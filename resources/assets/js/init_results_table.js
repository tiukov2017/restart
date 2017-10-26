
(function($){
    var table,$table,token,allowFilter,reportId,token;

    $(document).ready(function () {
        token = $('meta[name=csrf-token]').attr('content');
        reportId = $('#reportId').val();
        tableInit();
        initHandlers();
    });

    function initHandlers(){
        $(document).on('change','.switch input',toggleResultFiltering);
        $('#accepted-results').on("click",switchToAcceptedResults);
        $('#removed-results').on("click",switchToCanceledResults);
        $(document).on('click','.edit-cell',updateResult);
        $('#save-query').on('click',saveQuery);
    }

    function tableInit(){
        $('.glyphicon-plus-sign').remove();
        $('.navbar-default').remove();

        allowFilter = ['results-table'];
        $table = $('#results-table');
        token = $('meta[name="csrf-token"]').attr('content');
        table = $table.DataTable({
            "info":     false,
            "language": tablesLanguage,
            "columns" : [
                { "width": "10%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "5%" },
                { "width": "10%"},
                { "width": "5%" },
                { "width": "5%" }
            ],
            "bAutoWidth": false
        });
        $table.dataTableExt.afnFiltering.push(dataTableResultFilter);
        table.draw();
    }

    /**
     * @param oSettings
     * @param aData
     * @param iDataIndex
     * @returns {boolean}
     */
    function dataTableResultFilter(oSettings, aData, iDataIndex){
        var checked = $('#results-filter').val() == 'canceled';
        // if not table should be ignored
        if ( $.inArray( oSettings.nTable.getAttribute('id'), allowFilter ) == -1 ){
            return true;
        }
        return (checked && (aData[7] == "1")) || (!checked && aData[7] == "0")
    }

    /**
     *
     */
    function updateResult(){
        var $floppyIcon = $(this).find('.fa-floppy-o');
        var googleResult = createGoogleResult($(this));

        $floppyIcon.changeLoadingStatusIcon('loading',$floppyIcon,'badge');

        $.ajax({
            url: '{{ filteredGoogleResults/updateResult }}',
            method:'post',
            data: googleResult
        }).done(function(){
            $floppyIcon.changeLoadingStatusIcon('ready',$floppyIcon,'fa-floppy-o');
        });
    }

    /**
     *
     */
    function switchToAcceptedResults(){
        $('#results-filter').val('accepted');
        $(this).addClass('active');
        $('#removed-results').removeClass('active');
        table.draw();
    }

    /**
     *
     */
    function switchToCanceledResults(){
        $('#results-filter').val('canceled');
        $(this).addClass('active');
        $('#accepted-results').removeClass('active');
        table.draw();
    }

    /**
     *
      * @param $element
     * @returns {GoogleResult}
     */
    function createGoogleResult($element){
        var url = $element.closest('tr').find('[data-url]').data('url');
        var title = $element.closest('tr').find('[data-title]').val().trim();
        var description = $element.closest('tr').find('[data-description]').val().trim();
        var query = $element.closest('tr').find('[data-query]').data('query');
        var queryFk = $element.closest('tr').find('[data-query-id]').data('query-id');
        var result = new GoogleResult(url,title,description,query,'0',queryFk);

        result.user_comments = $element.closest('tr').find('[data-user-comments]').val().trim();
        result.reportId = $('#reportId').val();
        result._token = token;
        result.id = $element.closest('tr').data('id');

        return result;
    }

    /**
     *
     */
    function toggleResultFiltering(){
        var resultId = $(this).closest('.switch').data('result-id');
        var checked =  $(this).data('on');
        var cell = $(this).closest('tr').find('.hidden');
        $(this).data('on',!checked);

        if(checked){
            table.cell(cell).data('1').draw();
            removeResult(resultId);
        }
        else{
            table.cell(cell).data('0').draw();
            restoreResult(resultId);
        }
    }
    /**
     *
     * @param resultId
     */
    function restoreResult(resultId){
        $.ajax({
            url: '{{ search/preview/restoreResult }}',
            method: 'post',
            data: {'resultId': resultId , _token : token}
        }).done(updateTable);
    }

    /**
     *
     * @param resultId
     */
    function removeResult(resultId){
        $.ajax({
            url: '{{ search/preview/removeResult }}',
            method: 'post',
            data: {'resultId': resultId , _token : token}
        }).done(updateTable);
    }

    function updateTable(){

    }

    function saveQuery(){
        var query = $('[data-query-id]').val();
        var queryId = $(this).data('query-id');

        if(queryId != 0) {
            updateExistingQuery(queryId,query);
        }
        else{
            createQuery(query);
        }
    }

    function updateExistingQuery(queryId,query){
        var updateData = {
            reportId: reportId,
            queryId: queryId,
            token: token,
            name: query
        };
        googleApiService.updateReportQuery(updateData);
    }

    function createQuery(query){
        var updateData = {
            reportId: reportId,
            token: token,
            name: query
        };
        googleApiService.createReportQuery(updateData);
    }

})(jQuery);

