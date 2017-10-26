var googleApiService = (function(){

    var service = {
        updateReportQuery:updateReportQuery,
        createReportQuery:createReportQuery
    };

    return service;

    function updateReportQuery(updateData) {
        var $floppyIcon = $('.fa-floppy-o');
        $floppyIcon.changeLoadingStatusIcon('loading',$floppyIcon,'badge');

       return $.ajax({
            type: 'POST',
            url: '{{ googleSearch/query/update }}',
            data: {_token: updateData.token, report_id: updateData.reportId, id: updateData.queryId, name: updateData.name},
            success: function () {
                $floppyIcon.changeLoadingStatusIcon('ready',$floppyIcon,'fa-floppy-o');
                console.log('Report query has been updated!');
            },
            error: function () {
                console.log('Updated failed!')
            }
        });
    }

    /**
     *
     * @param updateData
     */
    function createReportQuery(updateData) {
      return $.ajax({
            type: 'POST',
            url: '{{ googleSearch/query/create }}',
            data: { _token: updateData.token, reportName: updateData.name, reportId: updateData.reportId },
            success: function() {
                console.log('Report query has been duplicated and created!');
            },
            error: function() {
                console.log('Duplicated and failed to create!')
            }
        });
    }

})();