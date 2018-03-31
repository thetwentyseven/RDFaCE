// JavaScript file for TinyMCE Contexto Plugin

( function() {
    tinymce.PluginManager.add( 'contexto', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'contexto_button_key', {
            // Button name and icon
            text: ' Contexto me!',
            image: '../wp-content/plugins/contexto/public/images/contexto-tinymce-icon.png',
            icon: false,
            tooltip: "Select the word you want and click this button.",
            // Button fnctionality
            onclick: function() {

              // Get text to variable content
              // More information on http://archive.tinymce.com/wiki.php/api4:method.tinymce.Editor.getContent
              var content = tinymce.activeEditor.getContent();
              // Get just the text highlighted by the user - More info: https://stackoverflow.com/questions/49220722/how-to-get-the-highlight-text-from-tinymce/49221138?noredirect=1#comment85447960_49221138
              var highlight = tinymce.activeEditor.selection.getContent({format: 'text'});
              console.log('Highlighted: '+ highlight);

              // using jQuery ajax
              // send the text to textrazor API with PHP
              $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: { 'action': 'send_text',
                    	  'content': ajax_object.content = content,
                        'highlight': ajax_object.highlight = highlight
                       },
                beforeSend: function(response) {
                  console.log('Sending...');
                  tb_show('Contexto', 'admin-ajax.php?action=loadingCall&highlight='+highlight);
                 },
                success: function(response){
                  // console.log(response);
                  if (response === content) {
                    tb_show('Contexto', 'admin-ajax.php?action=nofoundCall&highlight='+highlight);
                    console.log('Not found.');
                  } else {
                    // Sets the contents of the activeEditor editor. More info - https://www.tinymce.com/docs/api/tinymce/tinymce.editor/#setcontent
                    tinymce.activeEditor.setContent(response, {format: 'text'});
                    console.log('Success.')
                    tb_remove();
                  }
                }
              });


            } // onclick function

        } ); // TinyMCE button

    } ); // tinymce.PluginManager

} )(); // function
