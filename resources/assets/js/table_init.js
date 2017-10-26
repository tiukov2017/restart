(function ($) {

    $(document).ready(function () {

        $(document).on('click', '.glyphicon-plus-sign', function () {

            var $form = $($(this).data('form'));

            $form.slideDown('slow');

            var $sign = $(this).find('.glyphicon');

            $(this).removeClass('glyphicon-plus-sign');

            $(this).addClass('glyphicon-minus-sign');

        });

        $(document).on('click', '.glyphicon-minus-sign', function () {

            var $form = $($(this).data('form'));

            $form.slideUp('slow');

            $(this).removeClass('glyphicon-minus-sign');

            $(this).addClass('glyphicon-plus-sign');
        });
    });


})(jQuery);
