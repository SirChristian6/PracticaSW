var esVip=false
var esPasValida=false;
function verifyVip(){
	var email=$("#email").val();
	$.ajax({
        type: "GET",
        url: "../php/ClientVerifyEnrollment.php?email="+email,
	    cache: false,
	    success: function(response){
	        if(response=="NO"){
	            esVip=false;
	        	$("#regis").attr("disabled", true);
	        	$("#response1").html("Usted no es un usuario VIP!!!");
	        	$("#vip").attr("src","../images/charizard.gif");
	        }
	        else if(response=="SI"){
	        	$("#response1").html("Como usuario VIP puede registrarse sin problemas");
	        	$("#vip").attr("src","../images/dancingPikachu.gif");
	        	esVip=true;
	        	camposValidos();
	        }
		}
	});
}

function verifyPassword(){
	var pass=$("#pass1").val();
	$.ajax({
		data: {'password':pass},
        type: "POST",
        url: "../php/VerifyPassword.php",
	    cache: false,
	    success: function(response){
	        if(response=="INVALIDA"){
	            esPasValida=false;
	        	$("#regis").attr("disabled", true);
	        	$("#response2").html(" Esta contraseña es INVALIDA");
	        	$("#verpas").attr("src","../images/charizard.gif");
	        }
	        else if(response=="VALIDA"){
	            esPasValida=true;
	        	$("#response2").html(" La contraseña es VALIDA");
	        	$("#verpas").attr("src","../images/dancingPikachu.gif");
	        	camposValidos();
	        }
	        else if(response=="SIN SERVICIO"){
	        	esPasValida=false;
	        	$("#regis").attr("disabled", true);
	        	$("#response2").html("Lo sentimos pero no ha sido posible acceder al Servicio Web");
	        	$("#verpas").attr("src","../images/charizard.gif");
	        	
	        }
		}
	});
}

function camposValidos(){
	if(esVip && esPasValida){
		$("#regis").attr("disabled", false);
	}
}

$(document).ready(function(){
	if($("#email").val()!=''){
		esVip();
	}
	if($("#pass1").val()!=''){		
		verifyPassword();
	}
});