<?php
	include "DbConfig.php";
	require_once('../lib/nusoap.php');//incluimos la clase nusoap.php
	require_once('../lib/class.wsdlcache.php');//creamos el objeto de tipo soap_server
	
	$ns="https://sistemaswebchernandez.000webhostapp.com/PracticaSW/php/GetQuestionWS";
	$serv = new soap_server;
	$serv->configureWSDL('ObtenerPregunta',$ns);
	$serv->wsdl->schemaTargetNamespace=$ns;

	$serv->wsdl->addComplexType('pregunta','complexType','struct','all','',
		array('email'=>array('name'=>'email', 'type'=>'xsd:string'),
			'enunciado'=>array('name'=>'enunciado' , 'type'=>'xsd:string'),
			'respuesta'=>array('name'=>'respuesta' , 'type'=>'xsd:string')));

	$serv->register('ObtenerPregunta',array('id'=>'xsd:int'),array('return'=>'tns:pregunta'),$ns);

	function ObtenerPregunta($id){
		include "DbConfig.php";
		$mysqli=mysqli_connect($server,$user,$pass,$basededatos);

		if($mysqli){
			$sql = mysqli_query($mysqli, "SELECT email,pregunta,respcor FROM preguntas WHERE num_pregunta=".$id);
			if($sql){
				$row=mysqli_fetch_array($sql);
				
				$pregunta = array('email'=>$row['email'],'enunciado'=>$row['pregunta'],'respuesta'=>$row['respcor']);
				return $pregunta;
			}
		}
 		return $pregunta;
 	}
	//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
	if ( !isset( $HTTP_RAW_POST_DATA ) ) 
		$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	$serv->service($HTTP_RAW_POST_DATA);

?> 