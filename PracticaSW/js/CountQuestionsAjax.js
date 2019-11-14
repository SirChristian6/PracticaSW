function numPreguntas(){
	$.ajax({
        type: "POST",
        url: "../xml/Questions.xml",
        dataType: "xml",
	    cache: false,
	    success: function(preguntas){
	        var cont=0;
	        var cont2=$(preguntas).find("assessmentItems").children().length;
	        $(preguntas).find("assessmentItem").each(function () {
	        	if($(this).attr("author")==$("#email").val()){
	        		cont++;
	        	}
            });
            $("#contador").html(cont+"/"+cont2);
		}
	});
}
