$("#enviar").click(function (){
	var emailER=/^[a-z]+([0-9]{3}@ikasle.|(\.[a-z]+)?@)ehu\.(eus|es)$/;
	var email=$("#email").val();
	if(!emailER.test(email)){
		alert('E-mail inadecuado');
	}
	var pregunta=$("#pregunta").val();
	if($.trim(pregunta).length<10){
		alert("Pregunta demasiado corta");
	}
	var respC=$("#respC").val();
	if($.trim(respC).length==0){
		alert("Respuesta correcta vacia");
	}
	var resp1=$("#resp1").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 1 vacia");
	}
	var resp1=$("#resp1").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 2 vacia");
	}
	var resp1=$("#resp1").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 3 vacia");
	}
	var tema=$("#tema").val();
	if($.trim(tema).length==0){
		alert("Tema vacio");
	}
	return false;
});
