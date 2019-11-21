<?php
	
	require_once('../lib/nusoap.php');//incluimos la clase nusoap.php
	require_once('../lib/class.wsdlcache.php');//creamos el objeto de tipo soap_server
	$ns="https://sistemaswebchernandez.000webhostapp.com/PracticaSW/php/VerifyPassWS";
	$server = new soap_server;
	$server->configureWSDL('verifyPassword',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//registramos la función que vamos a implementar
	$server->register('verifyPassword',array('password'=>'xsd:string','ticket'=>'xsd:int'),array('return'=>'xsd:string'),$ns);
	//implementamos la función
	function verifyPassword($password, $ticket){
		if($ticket==1010){
			$myfile = fopen("../txt/toppasswords.txt", "r") or die("");
			while(!feof($myfile)) {

				$cmp = fgets($myfile);
			    $cmp = str_replace(array("\r", "\n"), '',$cmp);
	  			if( strcmp( $password,$cmp )==0 ){
	  				return new soapval('return', 'xsd:string', "INVALIDA");
	  			}
			}
			fclose($myfile);
			return new soapval('return', 'xsd:string', "VALIDA");
		}
	  	return new soapval('return', 'xsd:string', "SIN SERVICIO");
	}
	//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
	if ( !isset( $HTTP_RAW_POST_DATA ) ) 
		$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	$server->service($HTTP_RAW_POST_DATA);
?> 