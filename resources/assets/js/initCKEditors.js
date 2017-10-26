//CKeditor onselect plugin
CKEDITOR.plugins.add( 'onselect',{
    init : function( editor ){
        var timerSelect = 0;
        function getTextSelection(){
            clearTimeout(timerSelect);
            timerSelect = setTimeout(function(){
                editor.fire('select');
            },100);//c òàéìàóòîì ìîæíî ïîèãðàòü íà ñâîå óñìîòðåíèå
        }
        var startSelect = false;
        editor.on( 'contentDom', function(e){
            this.getCommand('cut').on('state',getTextSelection)
            editor.document.on('keyup',function(e){
                if ( e.data.$.shiftKey ){
                    var keyCode = e.data.$.keyCode;
                    if( keyCode>=33&&keyCode<=40 )getTextSelection();
                }
            });
            editor.document.on('mousedown',function(e){
                startSelect = true;
            });
            editor.document.on('mouseup',function(e){
                startSelect = false;
            });
        });
        window.onmousemove = function(e){
            if( startSelect )getTextSelection();
        };
        window.onmouseup = function(e){
            startSelect = false;
        };
        editor.on( 'selectionChange', getTextSelection );
        //editor.on( 'select', function(e){alert(editor.getSelection().getSelectedText() )});
    }
} );
