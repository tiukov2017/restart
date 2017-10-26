(function($){
    var token;
    $(document).ready(function () {
        token = $('meta[name=csrf-token]').attr('content');
        var $parentWindow = window.parent;

        $parentWindow.$($parentWindow.document).trigger('check-ready');

        $(document).on('click','.removeButton',removeInput);
        $(document).on('click','.addButton',addInput);
        $(document).on('click', '.duplicateButton', duplicateInput);
        $(document).on('click','.deleteButton', deleteInput);
        $('.sortable').sortable({'cursor':'move','axis':'y'}).disableSelection();
    });

    /**
     * Add one more query input to the form
     */
    function addInput(){
        var name = $(this).parent().find('input[type=text]').last().attr('name');
        var nameIndex = parseInt(name)+1;
        var inputElement = '<div class="form-group"> <div class="row"> ' +
            '<input type="text" class="form-control query-input" style="text-align: center">' +
            ' </div><span class="glyphicon glyphicon-minus-sign removeButton"></span></div>';
        $(inputElement).insertBefore($(this));
    }

    /**
     * Remove input temporary
     */
    function removeInput() {
        var template = $(this).parent().data('template');
        $(this).parent().remove();
    }

    /**
     * Duplicate input
     */
    function duplicateInput() {
        var inputValue = $(this).parent().find('input[type=text]').first().val();
        var reportId = $('#reportId').val();
        var result = createReportQuery(inputValue, reportId);

        result.done(function(data) {
            var form = $('#google-form');
            var reportQuery = data[0];

            // Create form group, row, input, removeBtn and deleteBtn
            // from the report query that we get from the server
            var formGroup = $('<div></div>').addClass('form-group ui-sortable-handle');
            var row = $('<div></div>').addClass('row');
            var input = $('<input>').addClass('form-control query-input')
                .css('text-align', 'center')
                .val(inputValue)
                .attr("data-query-id", reportQuery.id)
                .attr('name', inputValue);
            var removeBtn = $('<span></span>').addClass('glyphicon glyphicon-minus-sign removeButton');
            var deleteBtn = $('</span><span>').addClass('glyphicon glyphicon-trash deleteButton');

            // Combine all the elements together
            input.appendTo(row);
            row.appendTo(formGroup);
            removeBtn.appendTo(formGroup);
            deleteBtn.appendTo(formGroup);
            form.prepend(formGroup);
        });
    }

    /**
     * Delete input from the client and server
     */
    function deleteInput() {
        var reportQueryId = $(this).parent().find("input").attr("data-query-id");

        // Check if there is report query id and remove it from the server
        if(reportQueryId != undefined && reportQueryId != '') {
            removeReportQueryById(reportQueryId);
        }
        $(this).parent().remove();
    }


    function createReportQuery(query, reportId) {
        var updateData = {
            reportId: reportId,
            token: token,
            name: query
        };
        return googleApiService.createReportQuery(updateData);
    }

    /**
     * Remove report query by id
     * @param reportQueryId
     */
    function removeReportQueryById(reportQueryId) {
        token = $('meta[name=csrf-token]').attr('content');
        var url = 'googleSearch/query/remove/' + reportQueryId;
        $.ajax({
            type: 'POST',
            url: '{{ '+url+' }}',
            data: { _token: token },
            success: function() {
                console.log('Report query has been deleted!');
            },
            error: function () {
                console.log('Failed to delete!');
            }
        });
    }
})(jQuery);