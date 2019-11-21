<?php
	//incluimos la clase nusoap.php
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	$soapclient = new nusoap_client('https://sistemaswebchernandez.000webhostapp.com/PracticaSW/php/VerifyPassWS.php?wsdl',true);
	if(isset($_POST['password'])){
		//Llamamos la función que habíamos implementado en el Web Service
		//e imprimimos lo que nos devuelve
		$tic=1010;
		$result = $soapclient->call('verifyPassword',array('password'=>$_POST['password'],'ticket'=>$tic));
		echo($result);
	}
?>