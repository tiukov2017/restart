(function($){

    var $duplicateCheckElements,selectedText;

        $(document).ready(function () {
           //Handle text selection double check
           $(document).on('select','input,textarea,[contenteditable]',function(){
               selectedText = window.getSelection().toString();
                  $('#double-check-button').css('display','block');
           });
           //Handle net mentions title doubles check
          $(document).on('blur','[data-anchor=net-mentions]',function(){
              if($(this).val()!='' &&  !$(this).data('double-checked')) {
                  $duplicateCheckElements = $('[data-anchor=net-mentions]');
                   checkForDuplicates($(this), false);
                     $($duplicateCheckElements.find("#" + $(this).attr('id'))).val($(this).val());
                  $(this).data('double-checked','1');
              }
          });

            $(document).on('click','#double-check-button',function(){
                $duplicateCheckElements = $('[double-check=1] , [double-check=true]');
                  checkForDuplicates(selectedText,true);
                    selectedText = undefined;
                $(this).css('display','none');
            });
    });

    //Paste handler for the editors
    CKEDITOR.on('instanceReady',function(event){
        event.editor.on('select',function(event){
            selectedText = this.getSelection().getSelectedText();
               $('#double-check-button').css('display','block');
        });
    });
    //Search for duplicate value for $element ,alertFailure boolean flag
    function checkForDuplicates($element,alertFailure){
            var $duplicates = searchReportForDuplicateValues($element);

            if ($duplicates.length > 1) {
                $('.messages-container').pushAlert("הטקסט הנבחר קיים במקומות נוספים בדוח, הקש חץ למטה להצגתם",'alert-success').
                    setFadeOutTimer(window,'.alert-success',5000);
            }
            else{
                if(alertFailure){
                    $('.messages-container').pushAlert("לא נמצאו איזכורים נוספים לטקסט זה",'alert-success').setFadeOutTimer(window,'.alert-success',500);
                }
            }
    }

    function searchReportForDuplicateValues($element){
        var $duplicateElementsArr=[];
        var searchValue =($element instanceof $ && $element.val()!="") ? $element.val() : $element;
        var $all = $('input[type=text],textarea,[contenteditable]');

        $all.each(function(){
            var value  = $(this).text().trim()|| $(this).val();

            if (value.indexOf(searchValue)!=-1){
                 $duplicateElementsArr.push($(this));
            }
        });
        $($duplicateElementsArr).navigate(window);

        return $duplicateElementsArr;
    }
})(jQuery);