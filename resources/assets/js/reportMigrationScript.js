$(document).ready(function(){
    //Added Critical changed of report dom when changes made
    //This script shouldn't run on new generated reports only on existing ones
    //This is only temporary for development period
    var $report = $('#reportApp');

    var $migrationFlag = $report.find('#migrated');
    if($migrationFlag.length==0) {

        var $hiddenForm = $report.find('#hidden-report-data');
        var $duplicatedInput = $report.find('#user-name');
        var $hiddenProperties = $('#hidden-report-data').find('[data-prop]');
        var $menuButtons = $report.find('#menu-buttons');

        if ($report.find('[data-field=phone-number]').length != 0) {
            $report.find('[data-field=phone]').attr('data-field', 'mobile');
            $report.find('[data-field=phone-number]').attr('data-field', 'phone');
        }

        $report.find('#10_1').attr('data-field', 'objectId');
        $report.find('#16_1_1').attr('data-field', 'fax');
        $report.find('#16_1').attr('data-field', 'secondary-phone');
        $report.find('.profile_picture p').attr('data-field', 'full-name');


        $report.find('#2_1').attr('data-field','full-name');
        $report.find('#5_1').attr('data-field','english-full-name');

        $('#first-name').attr('data-field', 'objectFirstName');
        $('#last-name').attr('data-field', 'objectLastName');

        $('#english_first-name').attr('data-field', 'englishFirstName');
        $('#english_last-name').attr('data-field', 'englishLastName');


        if ($hiddenForm != []) {
            $hiddenForm.each(function () {
                $(this).remove();
            });
        }
        $hiddenProperties.each(function () {
            $(this).attr('name', $(this).data('prop'));
        });

        $duplicatedInput.each(function () {
            $(this).remove();
        });

        $menuButtons.each(function () {
            $(this).remove();
        });

        $report.append('<input type="hidden" id="migrated" value="true">');
        $migrationFlag.val(true);
    }
});