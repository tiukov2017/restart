(function($){
    var TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {

        $(document).on('click','.add-row',function(){

         var $table = $(this).closest('table');

         var $row = $(this).closest('tr').clone();

         $row.find('input[disabled]').removeAttr('disabled').removeAttr('value').empty();

         $row.find('input[name=id]').val('');

         $row.find('button').css('display','inline-block').data('url','{{ admin/domains/add }}');

         $row.find('.edit-row').css('display','inline-block');

         $row.find('.remove-row').css('display','inline-block');

         addTableRow($row,$table);

     });

        $(document).on('click','.edit-row',function(){

            var $url = '/checknet/public/admin/domains/update';

            var $row = $(this).closest('tr');

            $row.find('input[disabled]').removeAttr('disabled');

            $row.find('button').css('display','inline-block').data('url','{{ admin/domains/update }}');

        });

        $(document).on('click','.remove-row',function(){

            var $url = '{{ admin/domains/delete }}';

            var aprove = confirm("הרשומה תימחק ,האם להמשיך?");

            if(aprove){

                sendDomainsUpadteRequest($(this).closest('tr').find('form'),$url);

                $(this).closest('tr').remove();
            }

        });

        $(document).on('click','.send-btn',function(event){

            event.preventDefault();

            var $url = $(this).data('url');

            sendDomainsUpadteRequest($(this).closest('form'),$url);
        });

        function addTableRow($element,$containerElement){

            $element.appendTo($containerElement);
        }


        function sendDomainsUpadteRequest($form,$url){

            var $data = $form.serialize();

            $.ajax({
                url:$url,
                method:'post',
                data: $data
            }).success(function(response){
                alert('רשומה עודכנה בהצלחה');
            }).error(function(response){
                alert('עראה שגיאה');
            });

        }

    });

})(jQuery);