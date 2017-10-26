
(function($){

    var TOKEN = $('meta[name="csrf-token"]').attr('content');
    var $filesTable;
    var $updateStatusForm;
    var $updateOrderForm;
    var filesDataTable;
    var editorBasePath = '{{ editor/ }}';

    $(document).ready(function () {

        tableInit();

        $filesTable = $('#files-table');
        $updateOrderForm = $('#update-order');
        $updateStatusForm = $('#update-form');

        $('#table-upload').on('change',function(){
            $('.add-file').removeAttr('disabled')
        });

       //Handle report row click ,redirect to report editor
        $(document).on( 'click', '.update-row', function () {
            if(!$(this).hasClass('locked')) {
                if ($(this).data('report-edit')) {
                    window.location.href = $(this).data('report-edit');
                }
            }
        });

        //Handle update report status button
        $(document).on('click','#update-button',function(event){
            updateReportStatus(function(){window.location.reload();},$updateStatusForm);
        });

        //Handle update report status button and redirect to report on success
        $(document).on('click','#update-and-edit', function () {
            var reportId = $updateStatusForm.find('[name=reportId]').val();
            updateReportStatus(function(){window.location.href = editorBasePath + reportId;},$updateStatusForm);
        });

        //Handle report edit icon click
        $(document).on('click','.edit-cell',function(event){
            event.stopPropagation();

            var $row =$(this).closest('tr');
            $updateStatusForm.find('[name=status]').removeAttr('disabled');
            collectRowData.call($row,$updateStatusForm);

            $('#update-area').slideDown('slow');
            $updateStatusForm.slideDown('slow');

            getReportFiles($updateStatusForm.find('[name=reportId]').val());
            $('#update-order-area').css('display','block');
            collectRowData.call($row,$updateOrderForm);
        });

        //Handle references (camera icon) click
        $(document).on('click','.references-cell',function(event){
            event.stopPropagation();
        });

        $(document).on('change','select',function(){
            $('#update-button').removeAttr('disabled');
            $('#update-and-edit').removeAttr('disabled');
        });

        $(document).on('blur','[name=comment]',function(){
            $('#update-button').removeAttr('disabled');
            $('#update-and-edit').removeAttr('disabled');
        });

        //Handle remove file click icon ,removes file from db
        $(document).on('click','.remove-row',function(){
            var $fileId = $(this).data('id');
            var $form =  $('#update-order-area');
            var $reportId = $form.find('[name=reportId]').val();
            var $row = $(this).closest('tr');

            $.ajax({
                url: '{{ admin/report/files/delete }}',
                method:'post',
                data: {'fileId':$fileId,'reportId':$reportId,'_token':TOKEN}
            }).success(function(){
                $row.remove();
            }).error(function(response){
                displayAjaxError(response,$form);
            });
        });

        //Handle file editing
        $(document).on('click','.edit-row',function(){
            var $fileId = $(this).data('id');
            var $row = $(this).closest('tr');
            var $form = $('#update-order-area');
            var $reportId = $form.find('[name=reportId]').val();
            var $fileName = $row.find('[data-value=name]').find('input').val();
            var $description = $row.find('[data-value=description]').find('input').val();
            var url = $row.find('[data-value=url]').find('a').attr('href');

            $(this).changeLoadingStatusIcon('loading',$(this),'fa-pencil');

            var $elm = $(this);

            $.ajax({
                url: '{{ admin/report/files/edit }}',
                method:'post',
                data: {'fileId':$fileId,'reportId':$reportId,'fileName':$fileName,'fileDescription':$description,'url':url,'_token':TOKEN}
            }).success(function(){
                $elm.changeLoadingStatusIcon('ready',$elm,'fa-pencil');
            }).error(function(response){
                displayAjaxError(response,$form);
            });
        });

        //Handle file adding
        $(document).on('click','.add-file',function(event){
            event.preventDefault();
            var $loader =  $('.loader');
            var $files = $('.add-files');
            var $form = $('#update-order-area');
            var $reportId = $form.find('[name=reportId]').val();

            $loader.changeLoadingStatusIcon('loading',$loader,'hidden');


            var $formData = new FormData();
            //Collect all the files from input of type file
            if ($files[0].files.length > 0) {
                for (var i = 0; i < $files[0].files.length; i++) {
                    $formData.append('file-' + i, $files[0].files[i]);
                }
            }
            $files.val('');

            $('.file').find('.badge').text('');
            $('.add-file').attr('disabled',true);

            $formData.append('_token',TOKEN);
            $formData.append('reportId',$reportId);

            $.ajax({
                url: '{{ admin/report/files/add }}',
                method:'post',
                data: $formData,
                contentType: false,
                processData: false

            }).success(function(jsonFiles){
                convertJsonFilesToTable(jsonFiles);
                $loader.changeLoadingStatusIcon('ready',$loader,'hidden');
                $filesTable.pushAlert('הקובץ הוסף בהצלחה','alert-success').setFadeOutTimer(window,'.alert',1000);
            }).error(function(response){
                displayAjaxError(response,$filesTable);
                $loader.changeLoadingStatusIcon('ready',$loader,'hidden');
            });
        });
    });
    function updateReportStatus(successCallback,$form){

        $.ajax({
            url: '{{ admin/users/updatestatus }}',
            method:'post',
            data: $form.serialize()
        }).success(successCallback).error(function(response){
            displayAjaxError(response,$form);
        });
    }

    function tableInit(){
        var allowFilter = ['reports-table'];
        var $table = $('#reports-table');

        $.fn.dataTable.moment( 'DD/MM/YY HH:mm' );

        $('[data-toggle="popover"]').popover();
        $('.update-row').tooltip({placement: 'bottom', title: $(this).data('original-title'), html: true});

        var table = $table.DataTable({
            "info":     false,
            "language": tablesLanguage
        });

        $table.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
            var checked = $('#checkbox').is(':checked');
            if ( $.inArray( oSettings.nTable.getAttribute('id'), allowFilter ) == -1 )
            {// if not table should be ignored
                return true;
            }
            return (!checked && (aData[0] !='מוכן ללקוח' && aData[0] !='מבוטל'))
                ||
                (checked && aData[0])
        });

        table.columns( 2 ).order( 'desc' ).draw();
        $('#checkbox').on("click", function(e) {
            table.draw();
        });
    }

function getReportFiles(reportId){

    $.ajax({
        url: '{{ admin/report/files }}',
        method:'post',
        data: {'reportId':reportId,'_token':TOKEN}
    }).success(function(jsonFiles){
        convertJsonFilesToTable(jsonFiles)
    }).error(function(err){
        console.log(err);
    });
}

function convertJsonFilesToTable(jsonFiles){
    var $filesTable = $('#files-table');

    if(filesDataTable){
        $filesTable.find('tbody tr').remove();
    }
    var rows = JSON.parse(jsonFiles);

    $.each(rows,function(){

        var fileName = this.name;
        var description = this.description ? this.description : "";
        var url = this.url;
        var id = this.id;

        $filesTable.find('tbody:last').append('<tr><td data-value="name"><input type="text" value="'+fileName+'"></td>'+'' +
        '<td data-value="description"><input type="text" value="'+description+'"></td>'+
            '<td data-value="url"><a download href="'+url+'">'+url.substring(url.lastIndexOf('.'))+'</a></td>'+
        '<td><i data-id="'+id+'" data-toggle="tooltip" title="שמירה" class="fa fa-save fa-lg edit-row" aria-hidden="true"></i></td>'+
            '<td><i data-id="'+id+'" class="fa fa-trash remove-row" aria-hidden="true"></i></td></tr>');
    });
    if(!filesDataTable){

        filesDataTable =$filesTable.DataTable({  "info":false,
            "searching": false,
            "paging":false,
            "sorting" :false,
            "language": tablesLanguage,
            "columns" : [
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" },
                { "width": "20%" }]
        });
    }
}

    function addOption($select,optionValue,optionText){

        var option ='<option selected value='+optionValue+'>'+ optionText+'</option>';
        $(option).appendTo($select);
    }

    function collectRowData($form){
        var $rowData = $(this).find('[data-prop]');

        $rowData.each(function(){
            var $dataAttribute = $(this).data('prop');
            var value;

            switch ($dataAttribute){

                case 'user':
                    value = $(this).data('user-id');
                    addOption($form.find('[name=user]'),value,$(this).text().trim());
                    break;
                case 'status':
                    value = $(this).data('status-id');
                    $form.find('[name=status]').val(value);
                    break;

                default :
                    value = $(this).text().trim()||$(this).val().trim();
                    $form.find('[name='+$dataAttribute+']').val(value);
            }
        });
    }
})(jQuery);
