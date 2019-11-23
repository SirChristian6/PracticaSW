function insertarPregunta(){
	var dataString = $("#fquestion").serialize();
    $.ajax({
        type: "POST",
        url: "../php/AddQuestion.php",
        data: dataString,
        cache: false,
        success: function(data){
            verPreguntas();
            $("#respuestaServ").html(data);
    	}
	});
}