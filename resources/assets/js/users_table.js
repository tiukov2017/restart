(function($){

    $(document).ready(function () {

     var $table = $('#users-table');
        var table = $table.DataTable({
            "info":     false,
            "language": tablesLanguage
        });
        table.columns( 4 ).order( 'desc' ).draw();

        //Handle creating user
        $('#add-button').on('click',function(event){

            event.preventDefault();

            var $form =$(this).closest('form');

            var $data = $form.serialize();

            $.ajax({
                url:'{{ admin/users/add }}',
                method:'post',
                data: $data
            }).success(function(response){

                   $form.pushAlert(JSON.parse(response).status, 'alert-success');

            }).error(function(response){

                 displayAjaxError(response,$form);
            });
        });

        $(document).on('click','.user-row',function(){

            var userId = $(this).find('[data-prop = user-id]').val();

            var name = $(this).find('[data-prop = user-name]').text().trim();

            var phone = $(this).find('[data-prop = user-phone]').text().trim();

            var status = $(this).find('[data-prop = user-status]').text().trim();

            var role = $(this).find('[data-prop = user-role]').text().trim();

            var email = $(this).find('[data-prop=user-email]').text().trim();

            var $form = $('#update-form');

            $form.find('#id').val(userId);

            $form.find('#update-user-name').val(name);

            $form.find('#update-user-phone').val(phone);

            $form.find('#update-user-status').val(status);

            $form.find('#update-user-role').val(role);

            $form.find('#update-user-email').attr('placeholder',email);

            $('#update-area').css('display','block');

        });
    });

})(jQuery);
