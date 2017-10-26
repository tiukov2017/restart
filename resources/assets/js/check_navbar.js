(function($){
    var $editorReportIframe,$editorCheckIframe,$inputsContainer,$viewpopup,$alert;

    var $iframeNotAllowedSorces =['https://www.misim.gov.il/emosek/wHzanatTik.aspx','https://www.misim.gov.il/gmishurim/frmInputMeshalem.aspx?cur=0','https://dbrisk.dundb.co.il/HomepageLogin/risk.asp','https://pledges.justice.gov.il/','https://members.dbcredit.co.il/','https://ica.justice.gov.il/Request/OpenRequest?rt=CompanyExtract'];

    $(document).ready(function(){

        $inputsContainer = $('#inputs-container');
        $viewpopup = $('#editor-popup-view');
        $alert = $('.alert');
        $editorCheckIframe = $('#editor-check-iframe');


        $('#view-references').on('click', function () {
            $viewpopup.find('iframe').attr('src','{{ report/references/ }}'+REPORT_ID);
            $viewpopup.modal('show');
        });

        $('#view-order').on('click',function(){
            $viewpopup.find('iframe').attr('src','{{ report/order/ }}'+REPORT_ID);
            $viewpopup.modal('show');
        });

        $('#filtered-results-table').on('click',function(){
            var url = 'filteredGoogleResultsByReport/' + REPORT_ID;
            $editorCheckIframe[0].contentWindow.location.href = '{{ '+url+' }}'
        });

        $(document).on('report-ready', function(){
            $editorReportIframe=$('#editor-report-iframe');
            var $firstCheckBtn=$('.checklist-btn')[0];
            var $dataField=$($firstCheckBtn).attr('data-field');
            $($firstCheckBtn).addClass('check-active');
            fillCheckInputValues();
            changeReportFieldsFocus($editorReportIframe,$dataField);
        });

        $alert.on('close.bs.alert', function (event) {
            event.preventDefault();
        });

        $alert.find('.close').on('click',function(){
            $alert.css('display','none');
        });

        $(document).on('click','.checklist-btn',checkChange);

    });

    function checkChange(){

        localStorage.clear();

        var currentUrl =$editorCheckIframe[0].contentWindow.location.href;
        var $dataUrl=$(this).attr('data-url');//Url related to the check
        var $dataField=$(this).attr('data-field');//Report fields related to the check

        $editorCheckIframe.data('current-check', $(this).text().trim());

        $('.checklist-btn').removeClass('check-active');

        $(this).addClass('check-active');

        var checkName = $(this).data('check-name');
        var checkGuidelines = $(this).data('guidelines');

        $inputsContainer.find('h4').text(checkName);
        $inputsContainer.find('#check-guidelines span').text(checkGuidelines);

        $alert.show();

        if(currentUrl!=$dataUrl || $iframeNotAllowedSorces.indexOf($dataUrl)!=-1){
            changeCheckIframeUrl($editorCheckIframe,$dataUrl);
            resizeIframe($editorCheckIframe[0]);
        }
        changeReportFieldsFocus($editorReportIframe,$dataField);
        fillCheckInputValues();
    }

    function changeCheckIframeUrl(iframe,url){

        if($iframeNotAllowedSorces.indexOf(url)!=-1){
            var width = iframe.innerWidth();
            var height =900;
            if(iframe.attr('src')!=url){
                PopupCenter(url,width,height);
            }
        }
        iframe.attr('src',url);
    }

    function PopupCenter(url) {
        window.open(url,'_blank');
    }
    //Focus on the first field related to the check
    function changeReportFieldsFocus(iframe,field){
        var $dataAnchor = iframe.contents().find('[data-anchor='+field+']')[0];
        if($dataAnchor){
            iframe.contents().scrollTop($(iframe.contents().find('[data-anchor='+field+']')[0]).offset().top-150);
        }
        window.scroll(0,0);
    }

    function fillCheckInputValues(){
        var $reportIframe=$('#editor-report-iframe');
        var $editorIframe = $('#editor-check-iframe');
        var currentCheckNumber = $editorIframe.data('current-check');
        var currentCheckElement = $('.check-container').find('[data-number="'+currentCheckNumber+'"]')[0];
        var checkInputFields =  $(currentCheckElement).data('input-fields')? $(currentCheckElement).data('input-fields').toString().split(',') : [];
        var $inputsForm = $('#check-inputs-form');

        $inputsForm.empty();

        if(checkInputFields.length>0){
            var allInputs = findAllRelatedInputs(checkInputFields,$reportIframe);

            $(allInputs).each(function(){
                var $input = $reportIframe.contents().find('#'+this) ;
                var value = getElementValueByType($input);

                if(value){
                    var $label =$input.siblings('label');
                    var keyword = '<label>'+$label.text()+'</label><input type="text"  class="form-control" value="'+value+'" >';
                }
                $(keyword).appendTo($inputsForm);
            });
        }
    }
    //When inputs added dynamicly their id's look like : 237_1,237_2 etc. This method looks for all check relevant id's
    function findAllRelatedInputs(fieldsIdsArr,$targetIframe) {
        var allInputs = fieldsIdsArr;

            $(fieldsIdsArr).each(function () {
                var $inputs = $targetIframe.contents().find("[id^='" + this + "']").filter('input, [contenteditable] ,textarea');

                $inputs.each(function () {
                    var elementId = $(this).attr('id');

                   if($.inArray(elementId,allInputs)==-1){
                       allInputs.push(elementId);
                   }
                });
            });
        return allInputs;
    }

    function getElementValueByType($input){
        var value;

        if($input.is('textarea')){
            value = $input.text();
        }
        if($input.is('[contenteditable]')){
            value = $input.text();
        }
        if($input.is('input')){
            value = $input.val().toString();
        }
        return value;
    }
})(jQuery);