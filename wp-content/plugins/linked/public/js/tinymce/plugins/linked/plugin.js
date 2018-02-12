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

              // var content = editor.selection.select(editor.getBody(), true);
              var content = tinymce.activeEditor.getContent({format: 'text'});
              console.log(content);
              UserRequest(content);

              function UserRequest(content) {

                  var xhttp = new XMLHttpRequest();
                  xhttp.open("POST", "https://api.textrazor.com/text=" + content, true);
                  console.log(content);
                  console.log("https://api.textrazor.com/text=" + content);
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.setRequestHeader("X-TextRazor-Key", "6e3a64e825ce0eab60fe3801e190d41ea2794f245a61b4df315aa6b1");
                  xhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
                  xhttp.setRequestHeader('Accept-Encoding', 'gzip');
                  xhttp.send();
                  console.log(xhttp.responseText);
                  // var response = JSON.parse(xhttp.responseText);
              }







            }

        } );

    } );

} )();
