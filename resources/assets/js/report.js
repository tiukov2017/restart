(function($){

    var USER_INPUT_SELECTOR ='.user-input';
    var TOKEN = $('meta[name="csrf-token"]').attr('content');
    var PARENT_WINDOW =  window.parent;
    var REPORT_ID;
    var CHECK_NUMBER;
    var SECTION_1_HEADER = "פרטים אישיים";
    var SECTION_2_HEADER = "אזכורים ברשת";
    var SECTION_3_HEADER = "מידע פיננסי";
    var SECTION_4_HEADER = "מידע משפטי";
    var SECTION_5_HEADER = "מידע כלכלי";
    var GENERAL_SECTION_HEADER = "בדיקה מספר";

    var saveDone = $.Deferred();
    var whenSaveReady = $.when(saveDone);
    var $saveBtn;

    /**
     * @desc Array that holds all the editors that have been created
     * @type {Array}
     */
    var editors = [];
    //set listeners
    $(document).ready(function(){

        collapseContainers();

        var path = window.location.pathname;

        var $parentWindow= PARENT_WINDOW;

        REPORT_ID = path.substring(path.lastIndexOf('/')+1);

        $saveBtn = $('#saveBTN');

        $(document).on('click','.replaceAbleLink',replaceLinkUrl);
        $(document).on('click','.addButton',duplicateElement);
        $(document).on('click','.removeButton',removeElement);
        $(document).on('click','.status-change',changeStatus);

        $(window).resize(function(){$parentWindow.$($parentWindow.document).trigger('report-resize');});

        $(document).bind('check-ready',function(event,checkNumber){CHECK_NUMBER = checkNumber;});

        $parentWindow.$($parentWindow.document).trigger('report-ready');
        //Init sortable containers
        $('.sortable').sortable({'cursor':'move','axis':'y','cancel' :'[contenteditable],textarea,input', zIndex: 9999});
        init();
    });

    function init(){

        fillReportFields($('#reportApp'));
        initSavePanel();
        initUploadHandlers();
        initScreenShotHandlers();

        //input changes watcher
        setInputWatchers();

        //init the empty classes
        $(USER_INPUT_SELECTOR).trigger('input');

        initEditors($(document));
        initTextAreas();
        disablePasteWithFormatting();
    }

    function initScreenShotHandlers(){

        //Paste handler for all inputs
        $(document).on('paste','.user-input', function(event){

            saveScreenShot.call(this,event);
            createScreenShotIcon(this);
        });
        //Paste handler for the editors
        CKEDITOR.on('instanceReady',function(event){
            event.editor.on('paste',function(event){
                saveScreenShot.call(this.element.$,event,true);
                createScreenShotIcon(this.element.$);
            });
        });

        //Screenshot from the save and publish panel
        $('.general-screenshot').on('click',function(event){

            saveScreenShot.call(this,event);
            saveAction.call($saveBtn,true);
            PARENT_WINDOW.$(PARENT_WINDOW.document).trigger('screenshot',[$('.messages-container')]);
        });

        //Hanle clicking camera icon ,trigger screenshot event
        $(document).on('click','.screenshot',function(){
            PARENT_WINDOW.$(PARENT_WINDOW.document).trigger('screenshot',[$(this).parent()]);
            $(this).remove();
            saveAction.call($saveBtn,true);
        });
    }
    /** When pasting to content editable ,remove styles*/
    function disablePasteWithFormatting(){

        $('.table-cell-input [contenteditable]').on('paste',function(e) {

            e.preventDefault();

            var text = (e.originalEvent || e).clipboardData.getData('text/html');
            var $result = $('<div></div>').append($(text));

            $(this).html($result.html());

            // remove unnecesary tags (if paste from word)
            $(this).children('style').remove();
            $(this).children('meta').remove();
            $(this).children('link').remove();

            $(this).children().each(function() {
                var item = this;
                $(item).removeAttr('style');
                item = $(item).text();
            });
        });
    }

    function initUploadHandlers(){
        //Handle upload from button
        $(document).on('click','#upload-button',function(){

            $('#file-system-src').click();
        });
        //Handle upload from clicking on images
        $(document).on('click','.replaceAbleImage',function(){

            $('#upload-popup').modal('show');

            $image=$(this);
        });
         //Handle saving file from popup
        $('#save-file-btn').on('click', function(){

            var newSRC = $('#url-src').val();

            if($('#file-system-src').val()!='') {

                uploadImage($image);}

            else if(newSRC!='') {

                replaceImage($image,newSRC);}
        });

        $(document).on('change','#file-system-src',function(){

            $('#url-src').val($('#file-system-src').val());
        });

        $(document).on('focus','#url-src', function () {

            $('#file-system-src').val('');
        });
    }

    function initSavePanel(){

        var $saveMenu =  $('#save-menu');

        $saveMenu.find('.floating-menu-items').remove();

        var $menuButtons = $('#menu-buttons').find('.floating-menu-items');

        $menuButtons.appendTo($saveMenu);
        //Handle publish report action
        $('#publishReport').on('click',function(){

            publishReport.call($(this));
        });
        //Handle share url action
        $('#shareBTN').on('click',shareReport);
        //Handle save action
        $saveBtn.on('click',function(){
            saveAction.call(this);
        });
        //Toggle menu
        $('.floating-action-button').on('click',function(){

            var $buttons = $('.floating-menu-items');

            toggleMenu($buttons);
        });
        //Show publish modal if there are reminder fields
        $('#publish_popup_btn').on('click',function() {

            var $reminderDropdown = $('#reminder-fields');

            if ($reminderDropdown.find('li').length != 0) {

                $('#publish_popup').modal('show');
            }
            else {

                publishReport.call($('#publishReport'));
            }
        });
         //Show reminder alert
        $('#show-reminders').on('click',function(){

            $('#publish_popup').modal('hide');

            $('.reminder-alert').fadeIn();
        });
    }
    /** make textareas height auto*/
    function initTextAreas(){
        $("textarea").on('change keyup paste input ',function(e) {
            $(this).css('height','0');     //Reset height, so that it not only grows but also shrinks
            $(this).css('height',this.scrollHeight);
        });
    }


    function createScreenShotIcon(element){

        var screenShotElm =  '<i class="fa fa-camera screenshot view-mode-invisible" aria-hidden="true"></i>';

        $(screenShotElm).appendTo($(element).parent());
        $(screenShotElm).setFadeOutTimer(window,'.screenshot',7000);
    }

    function copyEditorPastedText(editorEvent){

        var editorText="";

        if(!editorEvent.data.text){

            $(editorEvent.data.dataValue).each(function(){

                editorText += $(this).text();
            });
        }
        else{

            editorText = editorEvent.data.dataValue;
        }
        return editorText;
    }


    function saveScreenShot(event,isEditor){

        var header,text,category;
        var categoryId = $(this).closest('.containerSection').attr('id') || 0 ;

        header = getContainerLabel($(this));
        category = getCategory(categoryId);
        PARENT_WINDOW.$(PARENT_WINDOW.document).trigger('paste',[document,$(this),{category:category,header:header}]);

    }

    function getContainerLabel($element){

        return $element.closest('.subsection_block').find('.subsection_label_block').text().trim();
    }

    function getCategory(categoryId){

        var category;

        switch(categoryId){

            case 'section_1':
                category = SECTION_1_HEADER;
                break;
            case 'section_2':
                category = SECTION_2_HEADER;
                break;
            case 'section_3':
                category = SECTION_3_HEADER;
                break;
            case 'section_4':
                category = SECTION_4_HEADER;
                break;
            case 'section_5':
                category = SECTION_5_HEADER;
                break;
            default :
                category = GENERAL_SECTION_HEADER +" "+ CHECK_NUMBER;

        }
        return category;
    }
    //Destroy editors
    function saveDestoryEditors(){
        var data,$element;

        editors.forEach(function(editorData){
            //fetch the editor data
            data  = editorData.editor.getData();
            //change the element content to the editor data
            $element =  $(editorData.element);
            $element.html("");
            $element.append($.parseHTML(data));

            //destroy the editor
            editorData.editor.destroy();
        });
        //clean the editors array
        editors = [];
    }

    /** @desc the actions to save the report */
    function saveAction(disableAlert){

        try{
            var $menu = $('.floating-menu-items');

            $menu.removeAttr('style');
            $menu.find($('.floating-menu-item')).css('pointer-events','none');

            $('.screenshot').remove();
            $('.alert').find('.close').click();
            //Update report fields that should be sent to the db
            updateReport();
            //updates all input changes to the dom
            saveCurrentDomState();
            //destroy the editors, to turn them back to normal html
            saveDestoryEditors();

            var content = $('#reportApp').html();

            //rebuild the editors to allow continue editing
            initEditors($(document));

            var requestUrl = $(this).data('target');
            var $reportHiddenFormData = $('#hidden-report-data').serialize()
        }

        catch(err){
            console.log(err);
            alert('שגיאה בשמירת הדוח, אנא נסה שנית');
        }
        $.ajax({
            url:requestUrl,
            method:'post',
            data: $reportHiddenFormData+'&'+ $.param({reportContent:content,id:REPORT_ID,_token:TOKEN})
        }).success(function(){
            if(!disableAlert){
                var $element = $('.messages-container');
                var $alert = $element.pushAlert('הדוח נשמר בהצלחה!','alert-success');
                $alert.setFadeOutTimer(window,'.alert-success',3000);
            }
            $('.floating-menu-item').css('pointer-events','all');
            saveDone.resolve();
            }).error(function(){
            alert('שגיאה בשמירת הדוח, אנא נסה שנית');
            saveDone.resolve();
        });
    }
    /** @desc the actions to publish the report */
    function publishReport(){

        collapseContainers();

        $('.floating-menu-item').css('pointer-events','none');
        $('#publish_popup').modal('hide');
        $('.modal-backdrop').remove();


        //save the current dom state.
        saveCurrentDomState();

        //destroy the editors, to turn them back to normal html
        saveDestoryEditors();

        detectEmptyEditors();

        var $ReportDOMCopy = $('html').clone();
        //rebuild the editors to allow continue editing
        initEditors($(document));

        $ReportDOMCopy.find('.script').remove();

        //apply the view mode
        $ReportDOMCopy.find('#reportApp').addClass('view-mode');

        setInputWatchers();

        ////tag empty editable p tags
        $ReportDOMCopy.find('p.user-input, textarea.user-input').trigger('input');

        //hide and tag empty subsections
        hideEmptySubsections($ReportDOMCopy);

        hideEmptyTables($ReportDOMCopy);

        //disable all inputs
        $ReportDOMCopy.find(USER_INPUT_SELECTOR).prop('disabled', true).prop('contenteditable',false);

        //hide all empty inputs
        $ReportDOMCopy.find('.empty_input').hide();

        //transform all smart editors textareas into divs to allow them display html
        $ReportDOMCopy.find('textarea.smartEditor').replaceWith(function(){
            return $("<div />", {html: $(this).html(), class: 'user-input'});
        });

        //disable the status boxes dropdown menu
        $ReportDOMCopy.find('.status-box').removeAttr('data-toggle');
        $ReportDOMCopy.find('.navigation').find('.active').removeClass('active');
        $($ReportDOMCopy.find('.navigation').find('.single_page')[0]).addClass('active');
        $ReportDOMCopy.find('.modal').remove();
        $ReportDOMCopy.find('#save-menu').remove();
        $ReportDOMCopy.find('#user-name').remove();
        $ReportDOMCopy.find('#app-navbar-collapse').remove();
        $ReportDOMCopy.find('#hidden-report-data').remove();
        $ReportDOMCopy.find('[src^="http://cdn.ckeditor.com"]').remove();
        $ReportDOMCopy.find('[href^="http://cdn.ckeditor.com"]').remove();

        var content = '<html>'+ $ReportDOMCopy.html() + '</html>';
        var requestUrl = $(this).data('target');

        $.ajax({
            url: requestUrl,
            method:'post',
            data: {reportContent:content,id:REPORT_ID,_token:TOKEN}

        }).success(function(){

            $('#shareBTN').css('display','block');
            $('#previewBTN').css('display','block');

            var $element = $('.messages-container');

            $('.floating-menu-item').css('pointer-events','all');

            saveAction.call($saveBtn,true);

            whenSaveReady.then(function(){
                var $alert = $element.pushAlert('הדוח פורסם בהצלחה!','alert-success');
                $alert.setFadeOutTimer(window,'.alert-success',3000);
                $('.floating-menu-item').css('pointer-events','all');
            });

        }).error(function(){
            alert('שגיאה בפרסום הדוח, אנא נסה שנית');
        });
    }

    /** @desc close all opened containers of report*/
    function collapseContainers(){
        var $collapseButtons =$('[data-toggle="collapse"]');

        $collapseButtons.each(function(){
            if(!$(this).hasClass('collapsed')){
              $($(this).data('target')).removeClass('in');
                $(this).addClass('collapsed');
            }
        });
    }

    function hideEmptySubsections($dom){
        //hide and tag empty subsections
        $dom.find('.subsection_block').each(function(){
            var $this = $(this);

            if($this.find('.user-input').length == $this.find('.user-input.empty_input').length){
                $this.addClass('hidded');
                $this.hide();
            }
        });

        $dom.find('.containerSection:not("#section_1")').each(function(){
            var $this = $(this);
            if($this.find('.subsection_block').length == $this.find('.subsection_block.hidded').length){
                $this.hide();
            }
        });
        //hide expand buttons that there target don't have any visible input
        $dom.find('.moreDetailsButton').each(function(){
            var $this = $(this);
            var $target =  $($this.data('target'));

            if($target.find(USER_INPUT_SELECTOR).length == $target.find('.user-input.empty_input').length){
                $this.hide();
            }
        });
        var $addressField =  $dom.find('.address');

        if($addressField.hasClass('empty_input')){
            $dom.find('.address-images-container').addClass('empty_input');
            $dom.find('#section_1').css('padding-bottom','0');
            $dom.find('.address-images-container').siblings('.button').css('padding-bottom','0');
        }

    }
    function detectEmptyEditors(){

        $(document).find('textarea.user-input').each(function(){

            var $this = $(this);

            if($this.html().trim().length == 0)
            {
                $this.addClass('empty_input');
                $this.closest('.containerField').addClass('empty_input');
            }
            else{
                $this.removeClass('empty_input');
                $this.closest('.containerField').removeClass('empty_input');
            }
        });
    }
    function hideEmptyTables($element){

        $tables= $element.find('table');

        $tables.each(function(){

            var $table=$(this);
            var empty=true;
            var $tableInputs= $(this).find('.table-cell-input');

            if($tableInputs.length>0){

                $tableInputs.each(function(){
                    if($(this).find('.user-input.empty_input').length==0){
                        empty=false;
                    }
                });
                if(empty==true){
                    $table.addClass('empty_input');
                    $table.closest('.containerField').addClass('empty_input');
                }
            }
        });
    }
    function shareReport(){

        var shareUrl = $(this).data('share-url');

        prompt('This is your report share address, copy paste and send it.',shareUrl);
    }

    /** @desc replaces the link url by a new url given by the client */
    function replaceLinkUrl(event){
        //first prevent the link default behavior
        event.preventDefault();

        var currentSRC = $(this).attr('href');
        var newSRC = prompt('set new url:', currentSRC);

        if(newSRC!=currentSRC && newSRC!==null){
            $(this).attr('href',newSRC)
        }
    }
    /** @desc Upload image from file */
    function uploadImage($image){

        var $form = $('#upload-form');

        $form.find('input[name="_token"]').val(TOKEN);
        var $data =new FormData($form[0]);
        $data.append('id',REPORT_ID);

        $.ajax({
            type:'POST',
            url:$form.attr('action'),
            data:$data,
            contentType: false,
            processData: false,

            success:function(result){
                replaceImage($image,result);
            },

            error:function(err){
            }
        });
    }
    /** @desc replaces the image src by a new src given by the client */
    function replaceImage($image,newSRC){
        var $this = $image;
        var inputSelector = $this.data('target');
        var currentSRC = $this.attr('src');

        if(newSRC!=currentSRC && newSRC!==null){
            if(!newSRC){
                $(inputSelector).val('');
            }else {
                $(inputSelector).val(newSRC);
                $this.removeClass('empty_input');
            }
            $(inputSelector).trigger('input');

            newSRC = newSRC || $this.data('default');

            $this.attr('src',newSRC);

            if($(this).hasClass('socialTitleIcon')) {
                $(this).addClass('img-circle');
            }
        }
    }
    /**
     * @desc Saves the current state of the dom, to be part of the html intial node.
     */
    function saveCurrentDomState(){
        // it's defaultValue so we can use innerHTML
        $("input, textarea:not('.smartEditor')").each(function () {

            this.defaultValue = this.value;
        });
        // go through each select and replace
        // it's selection so we can use innerHTML
        $(" select > option").each(function () {
            if (this.selected)
            {
                this.setAttribute("selected", true);
            } else
            {
                this.removeAttribute("selected");
            }
        });
    }
    /**
     * @desc Adds or remove the empty_input class, whenever input is changed,to empty
     */
    function setInputWatchers(){

        $(USER_INPUT_SELECTOR).on('input',toggleInputValueClass);

        function toggleInputValueClass(event){

            var $elem = $(this);
            var $container = $elem.closest('.containerField');

            if (($elem.is('input, textarea') && $elem.val()  == false) || (!$elem.is('input, textarea') && $elem.html().trim().length == 0) ){
                $elem.addClass('empty_input');
                $container.addClass('empty_input');
            }
            else {
                $elem.removeClass('empty_input');
                $container.removeClass('empty_input');
            }
        }
    }
    /**
     * @desc  Clones existing DOM element and generates unique id for each child
     */
    function duplicateElement(){

        var $uniqueCounterElm,$uniqueCounter,$clonedElement,$parentContainer,$cloneTargetElement,$this;

        $this = $(this);
        $uniqueCounterElm = $('#unique-counter');
        $uniqueCounter = parseInt($uniqueCounterElm.val());
        $uniqueCounterElm.val(++$uniqueCounter);
        $cloneTargetElement = $this.closest($this.data('target'));
        $parentContainer = $cloneTargetElement.parent();
        $clonedElement = $cloneTargetElement.clone();

        clearInputsAndEditors($clonedElement);
        replaceIds($clonedElement,$uniqueCounter);
        replaceLabels($clonedElement,$uniqueCounter);
        replaceNames($clonedElement,$uniqueCounter);
        replaceDataTarget($clonedElement,$uniqueCounter);
        trancuateClonedInputs($clonedElement);
        showRemoveButton($clonedElement);

        $parentContainer.append($clonedElement);
        //Init editors for cloned inputs
        initEditors($clonedElement);

        if($this.data('scroll')){

            $('body, html').animate({ scrollTop: $($clonedElement).offset().top-100 }, 1000);
        }
    }
    /**
     * @desc  Remove block
     */
    function removeElement(){
        var $targetElement,$prevElement,$this,targetSelector;

        $this = $(this);
        targetSelector = $this.data('target');
        $targetElement=$this.closest($this.data('target'));
        $prevElement=$($targetElement).prev(targetSelector);

        if($this.data('scroll')){

            $('body, html').animate({ scrollTop: $($prevElement).offset().top-100 }, 1000,function(){
                $targetElement.remove();
            });
        }
        else{
            $targetElement.remove();
        }
    }
    function showRemoveButton(element){
        element.find('.removeButton').css('display','inline-block');
    }
    /**
     * @desc  Generate unique ids to element children
     */
    function replaceIds(element,number) {

        $.each(element.find('*[id]'), function () {
            $id = $(this).attr('id');
            $(this).attr('id', $id + "_" + number);
        });
    }
    /**
     * @desc  Generate unique labels for elment children
     */
    function replaceLabels(element,number){

        $.each(element.find('*[for]'), function () {
            var $labelforId=$(this).attr('for');
            $(this).attr('for',$labelforId+"_"+number);
        });
        $.each(element.find('li[role="presentation"]'), function () {
            var $labelTabId=$(this).find('a').attr('href');
            $(this).find('a').attr('href',$labelTabId+"_"+number);
        });
    }
    /**
     * @desc  Generate unique names for elment children
     */
    function replaceNames(element,number){

        $.each(element.find('*[name]'), function () {
            var $name=$(this).attr('name');
            $(this).attr('name',$name+"_"+number);
        });
    }
    /**
     * @desc  Generate unique data-targets for elment children
     */
    function replaceDataTarget(element,number){

        $.each(element.find('*[data-target]'), function () {

            var  dataTarget=$(this).attr('data-target');

            //only change targets that are based on ids
            if(dataTarget.charAt(0)=='#')
                $(this).attr('data-target',dataTarget+"_"+number);
        });
    }
    /**
     * @desc  Clean inputs on cloned element
     */
    function trancuateClonedInputs(element){

        $.each(element.find('.user-input'), function () {

            var $this = $(this);

            if($this.is('input') || $this.is('textarea')){
                $this.val('');
            }
            else{
                $this.html('');
            }
            $this.trigger('input');
        });
    }
    /** @desc changes the header status icon */
    function changeStatus(event){

        event.preventDefault();

        var $this = $(this);
        var $statusBox = $($this.closest('*[data-target]').data('target'));
        var $statusImg = $statusBox.find('img');
        var statusTitle = $this.text();
        var statusImgSrc = $this.data('icon');

        if($this.hasClass('status-reset')){
            //if no status hide the status box on view mode
            $statusBox.addClass('view-mode-invisible');

        }else{
            $statusBox.removeClass('view-mode-invisible');
        }
        $statusImg.attr('src',statusImgSrc);

        $statusImg.attr('title',statusTitle);
    }

    /** @desc clear all user editable elements */
    function clearInputsAndEditors($element){

        $element.find('input[type=text]').val('');
        $element.find('.screenshot').remove();
        $element.find('textarea').html('');
        $element.find('textarea').removeAttr('style');
        $element.find('.cke_editable').remove();
        $element.find('.smartEditor').html('');

        $img= $element.find('.replaceAbleImage');
        $img.attr('src',$img.data('default'));

        $.each($img,function(){

            if(!$(this).hasClass('socialTitleIcon')){
                $(this).addClass('empty_input');
            }
        });
    }
    function toggleMenu($menuItemsContainer){

        if(!$menuItemsContainer.hasClass('opened')){
            $menuItemsContainer.slideDown('fast');
            $menuItemsContainer.addClass('opened');
        }
        else{
            $menuItemsContainer.slideUp('fast');
            $menuItemsContainer.removeClass('opened');
        }
    }

    function fillReportFields($form){

        var $data = $('[data-prop]');

        $data.each(function(){
            var $dataAttribute = $(this).data('prop');
            var value = $(this).val();

            $form.find('[data-field='+$dataAttribute+']').val(value);
        });

        $form.find('[data-field=full-name]').text($('[data-prop=full-name]').val());

    }

    function updateReport(){

        var $report = $('#reportApp');
        var $hiddenForm = $('#hidden-report-data');
        var $reportData = $report.find('[data-field]');

        //Generate full name
        var hebrewName = $('#2_1').val();
        var spaceIndex = hebrewName.indexOf(' ');
        var firstName = hebrewName.substring(0,spaceIndex).trim();
        var lastName = hebrewName.substring(spaceIndex+1).trim();

        $('[data-field=full-name]').text(hebrewName);

        $('#first-name').val(firstName);
        $('#last-name').val(lastName);

        //Generate english full name
        var englishName = $('#5_1').val();
        spaceIndex = englishName.indexOf(' ');
        firstName = englishName.substring(0,spaceIndex).trim();
        lastName = englishName.substring(spaceIndex+1).trim();

        $('#english_first-name').val(firstName);
        $('#english_last-name').val(lastName);

        $reportData.each(function(){
            var $dataAttribute = $(this).data('field');
            $hiddenForm.find('[data-prop='+$dataAttribute+']').val($(this).val());
        });

    }

    /** init all the editors */
    function initEditors($element){

        var $smartEditors=$element.find('.smartEditor');
        //Toolbar buttons config
        CKEDITOR.config.toolbarGroups = [
            { name: 'document', groups: [ 'doctools', 'mode', 'document' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
            { name: 'forms', groups: [ 'forms' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },
            { name: 'insert', groups: [ 'insert' ] },
            '/',
            { name: 'styles', groups: [ 'styles' ] },
            { name: 'colors', groups: [ 'colors' ] },
            { name: 'tools', groups: [ 'tools' ] },
            { name: 'others', groups: [ 'others' ] },
            { name: 'about', groups: [ 'about' ] }
        ];
        CKEDITOR.config.removeButtons = 'Source,Templates,Save,NewPage,Preview,Print,' +
            'Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,' +
            'TextField,Textarea,Select,Button,ImageButton,HiddenField,Italic,' +
            'Strike,Subscript,Blockquote,CreateDiv,Language,Anchor,Flash,SpecialChar,PageBreak,Iframe,Styles';

        CKEDITOR.config.colorButton_colors = 'FFF,000';

        CKEDITOR.config.floatSpaceDockedOffsetY = 400;
        //disable the auto init of the cke editor
        CKEDITOR.disableAutoInline = true;

        CKEDITOR.config.extraPlugins = 'image,uploadimage,uploadwidget,filebrowser,onselect';
        //This is not a smiley just user defined icon in editor
        CKEDITOR.config.smiley_path ='https://s3-eu-west-1.amazonaws.com/checknet-assets/editor-icons/';

        CKEDITOR.config.smiley_images =['attention.png'];

        CKEDITOR.config.smiley_descriptions = ['attention'];
        //Url for uploading image from drag and drop feature of ckeditor
        CKEDITOR.config.imageUploadUrl = '{{ report/uploadfromdrop?_token='+TOKEN+'&id='+REPORT_ID+' }}';
        //Url for uploading image from regular upload feature of ckeditor
        CKEDITOR.config.filebrowserImageUploadUrl = '{{ report/uploadfromeditor?_token='+TOKEN+'&action=QuickUpload&type=Images&id='+REPORT_ID+'}}';

        //Configure table apperiance in ckeditor
        CKEDITOR.on('dialogDefinition', function( ev ) {

            var dialogName = ev.data.name;

            var dialogDefinition = ev.data.definition;

            if(dialogName === 'table') {

                var infoTab = dialogDefinition.getContents('info');

                var cellSpacing = infoTab.get('txtCellSpace');
                cellSpacing['default'] = "0";

                var cellPadding = infoTab.get('txtCellPad');
                cellPadding['default'] = "0";

                var border = infoTab.get('txtBorder');
                border['default'] = "0";

                var width = infoTab.get('txtWidth');
                width['default']='95%';
            }
        });
        //init the editor on any edtior that haven't been initiated yet
        $smartEditors.each(function(){
            var editor = {editor: CKEDITOR.inline( this), element: this};
            //init the editor and push it to the editor array
            editors.push(editor);
        });
    }

})(jQuery);