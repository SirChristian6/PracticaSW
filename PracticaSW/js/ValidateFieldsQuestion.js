function validar(){
	
	
	var errno=0;
	var text="";
	var pregunta=$("#pregunta").val();
	if($.trim(pregunta).length<10){
		text+="\n\rPregunta demasiado corta";
		errno++;
	}
	var respC=$("#respc").val();
	if($.trim(respC).length==0){
		text+="\n\rRespuesta correcta vacia";
		errno++;
	}
	var resp1=$("#resp1").val();
	if($.trim(resp1).length==0){
		text+="\n\rRespuesta incorrecta 1 vacia";
		errno++;
	}
	var resp2=$("#resp2").val();
	if($.trim(resp1).length==0){
		text+="\n\rRespuesta incorrecta 2 vacia";
		errno++;
	}
	var resp3=$("#resp3").val();
	if($.trim(resp1).length==0){
		text+="\n\rRespuesta incorrecta 3 vacia";
		errno++;
	}
	var tema=$("#tema").val();
	if($.trim(tema).length==0){
		text+="\n\rTema vacio";
		errno++;
	}
	if(errno>0){
		alert(text);
		return false;
	}
	insertarPregunta();
	return true;
	
}

