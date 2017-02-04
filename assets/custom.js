$(document).ready(function() {

    var HelloButton = function (context) {
      var ui = $.summernote.ui;

      // create button
      var button = ui.button({
        contents: '<i class="fa fa-child"/> Hello',
        tooltip: 'hello',
        click: function () {
          // invoke insertText method with 'hello' on editor module.
          context.invoke('editor.insertText', 'hello ');
        }
      });

      return button.render();   // return button as jquery object
    }

    $('#summernote').summernote({

        height: 300,
        disableResizeEditor: true,

        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['insert', ['link']],
          ['font', ['superscript', 'subscript']],
          ['list', ['ul', 'ol']],
          ['mybutton', ['hello']],
          ['misc', ['fullscreen']]
        ],

        buttons: {
          hello: HelloButton
        }

    });

    // remove summernote bottom of editor that looks dragable
    $('.note-icon-bar').hide();
    $('.note-resizebar').css({'background-color': '#FFFFFF', 'border-radius': '5px', 'cursor': 'initial'});

    console.log("custom.js running");


    $("#allOptions").find(':checkbox').click(function(){
        console.log($(this).val());
        $('#' + $(this).val()).toggle();
    })

    $('#thePostForm').submit(function() {
        validateForm();
    });

    function validateForm() {
        var markupStr = $('#summernote').summernote('code');
        $('#thePostContents').val(markupStr);
        //console.log("Current contents of summernote:");
        //console.log(markupStr);
    }

    // Put contents of past save into summernote post
    previouslySavedText = $('#thePostContents').val();
    $('#summernote').summernote('code', previouslySavedText);

});
