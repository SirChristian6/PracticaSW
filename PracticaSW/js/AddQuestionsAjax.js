function insertarPregunta(email){
	var dataString = $("#fquestion").serialize();
    $.ajax({
        type: "POST",
        url: "../php/AddQuestion.php?email="+email,
        data: dataString,
        cache: false,
        success: function(data){
            verPreguntas();
            $("#respuestaServ").html(data);
    	}
	});
}