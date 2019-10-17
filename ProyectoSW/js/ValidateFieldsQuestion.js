$("#enviar").click(function (){
	var emailER=/^[a-z]+([0-9]{3}@ikasle\.|(\.[a-z]+)?@)ehu\.(eus|es)$/;
	var email=$("#email").val();
	var errno=0;
	if(!emailER.test(email)){
		alert('E-mail inadecuado');
		errno++;
	}
	var pregunta=$("#pregunta").val();
	if($.trim(pregunta).length<10){
		alert("Pregunta demasiado corta");
		errno++;
	}
	var respC=$("#respC").val();
	if($.trim(respC).length==0){
		alert("Respuesta correcta vacia");
		errno++;
	}
	var resp1=$("#resp1").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 1 vacia");
		errno++;
	}
	var resp2=$("#resp2").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 2 vacia");
		errno++;
	}
	var resp3=$("#resp3").val();
	if($.trim(resp1).length==0){
		alert("Respuesta incorrecta 3 vacia");
		errno++;
	}
	var tema=$("#tema").val();
	if($.trim(tema).length==0){
		alert("Tema vacio");
		errno++;
	}
	if(errno>0){
		return false;
	}
	return true;
	
});
