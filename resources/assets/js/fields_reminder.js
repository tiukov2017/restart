(function($){

    $(document).ready(function() {

        var $reminderAlert = $('.reminder-alert');
        var $reminderDropdown =$('#reminder-fields');
        var $alertIcon = $('.missing-fields-alert');

        if($reminderDropdown.find('li').length!=0){
            $alertIcon.css('display','flex');
        }

        $alertIcon.on('click',function(){
        $reminderAlert.fadeIn();
        });

        $reminderAlert.on('close.bs.alert', function (event) {
            event.preventDefault();
         });

        $reminderAlert.find('.close').on('click',function(){
            $reminderAlert.css('display','none');
        });

       $(document).on('click','.remind-field',function(event){

           event.stopPropagation();

           if(!$(this).find('i').hasClass('active')){
               addReminderListItem($(this));
               $alertIcon.css('display','flex');
           }
           else{
               removeReminderListItem($(this));

               if($reminderDropdown.find('li').length==0){
                   hideAlert();
               }
           }
       });

        $(document).on('click','.field',function(){

            var fieldId = $(this).data('id');
            var $field = $('#'+fieldId);

            $field.scrollToElement($field);
        });

        function hideAlert(){

            $reminderAlert.css('display','none');
            $alertIcon.css('display','none');
        }

        function showAlert(){

            $reminderAlert.css('display','block');
            $alertIcon.css('display','flex');
        }

        function addReminderListItem($reminderElement){

            $reminderElement.find('i').addClass('active');

            var fieldId = $reminderElement.data('remind-field');
            var title = $('#'+fieldId).closest('.subsection_block').find('.subsection_label_block').text().trim();
            var element = '<li class="field" data-id="'+fieldId+'"><a>'+title+'</a></li>';

            $(element).appendTo($reminderDropdown);
        }

        function removeReminderListItem($reminderElement){

            $reminderElement.find('i').removeClass('active');
            var removeId = $reminderElement.data('remind-field');
            $reminderDropdown.find('[data-id='+removeId+']').remove();
        }
    });
})(jQuery);
