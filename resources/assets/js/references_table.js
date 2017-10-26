(function($){

    $(document).ready(function () {
        $('#references-table').DataTable({

            "info":     false,
            "searching": false,
            "columns" : [
                { "width": "20%" },
                { "width": "35%" },
                { "width": "15%" },
                { "width": "30%" }
            ],
            "bAutoWidth": false,
            "language":tablesLanguage });

        $(document).on('mousedown','[data-toggle=modal]',function(){

            var $modal = $('#image-preview');

            $modal.find('.modal-body').find('iframe').attr('src',$(this).data('url'));

            $modal.modal('show');
        });
    });
})(jQuery);
