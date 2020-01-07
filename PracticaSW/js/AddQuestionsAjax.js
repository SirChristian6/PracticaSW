function insertarPregunta(){
 
    // Get form
    var form = $('#fquestion')[0];

   // Create an FormData object 
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../php/AddQuestion.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data){
            verPreguntas();
            $("#respuestaServ").html(data);
        }
    });
}