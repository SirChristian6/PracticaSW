$('#enviar').click(function() {
	$.get('../xml/Users.xml', function(d){
		var listacorreos = $(d).find('email');
		var i;
		var encontrado=false
		for ( i = 0; i < listacorreos.length; i++){
			if(listacorreos[i].childNodes[0].nodeValue== $('#email').val()){
				encontrado=true;
				break;
			}
		}
		if(encontrado){
			var listaNombres=$(d).find('nombre');
			$('#nom').attr('value',listaNombres[i].childNodes[0].nodeValue);
			var listaApell1=$(d).find('apellido1');
			var listaApell2=$(d).find('apellido2');
			$('#apell').attr('value',listaApell1[i].childNodes[0].nodeValue+" "+listaApell2[i].childNodes[0].nodeValue);
			var listaTelef=$(d).find('telefono');
			$('#telf').attr('value',listaTelef[i].childNodes[0].nodeValue);
		}
		else{
			
			$('#nom').attr('value',"");
			$('#apell').attr('value',"");
			$('#telf').attr('value',"");
			alert("Email no existente");
		}

	})
});