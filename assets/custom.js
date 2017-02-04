$(document).ready(function() {


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
