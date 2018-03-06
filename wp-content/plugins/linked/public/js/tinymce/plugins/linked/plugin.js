// JavaScript file for TinyMCE Linked Plugin
//
//
//
( function() {
    tinymce.PluginManager.add( 'linked', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'linked_button_key', {
            // Button name and icon
            text: 'Semantic Notation',
            icon: false,
            // Button fnctionality
            onclick: function() {

              // Get text to variable content
              // More information on http://archive.tinymce.com/wiki.php/api4:method.tinymce.Editor.getContent
              var content = tinymce.activeEditor.getContent();

              // using jQuery ajax
              // send the text to textrazor API with PHP
              $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: { 'action': 'send_text',
                    	  'content': ajax_object.content = content
                       },
                beforeSend: function() {
                  console.log('Sending...');
                 },
                success: function(response){
                  // console.log(response);
                  // Sets the contents of the activeEditor editor. More info - https://www.tinymce.com/docs/api/tinymce/tinymce.editor/#setcontent
                  tinymce.activeEditor.setContent(response, {format: 'text'});
                  console.log('Call finished.')
                }
              });


            } // onclick function

        } ); // TinyMCE button

    } ); // tinymce.PluginManager

} )(); // function
