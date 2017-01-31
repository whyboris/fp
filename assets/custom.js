$( document ).ready(function() {


    //console.log( "ready!" );


    $("#allOptions").find(':checkbox').click(function(){
        console.log($(this).val());
        $('#' + $(this).val()).toggle();
    })

});
