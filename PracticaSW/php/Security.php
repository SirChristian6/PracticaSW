<?php
    session_start();
	$encontrado=0;
	if (isset($_SESSION['email']) && isset($_SESSION['passwd'])) {
		include "DbConfig.php";
		$mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Abrir conexion con la BD
		if($mysqli){
			$sql = mysqli_query($mysqli, "SELECT email,password,rol,avatar,estado FROM usuarios" ); //Sentencia SQL para conseguir los emails
			if ($sql){
				$email=$_SESSION['email'];
				$password=$_SESSION['passwd'];
				while( $usuarios=mysqli_fetch_array($sql) ){	//comparar email de la URL con los existentes en la BD

					
					if( strcmp($usuarios['email'], $email)==0 &&  strcmp($usuarios['password'], $password)==0){
						if(strcmp($usuarios['estado'],"bloqueado")==0){
    						$xml = simplexml_load_file("../xml/Counter.xml");
    						foreach($xml->children() as $user){
    						    if($user['email']==$_SESSION['email']){
    						        unset($user[0]);
    						        break;
    						    }
    						}
    						$xml->asXML("../xml/Counter.xml") ;
    						session_destroy();
    						echo("<script> alert('Usted esta bloqueado, no puede acceder a los servicios, consulte con el administrador');");
    						echo("location.href='Layout.php';</script>");
    					}
						if(strcmp($usuarios['rol'], "admin")==0){
							$encontrado=1;
						}
						else{
							$encontrado=2;
						}
						$_SESSION['avatar']=$usuarios['avatar'];
						break;
					}
				}
				$sql->close();
			}
			mysqli_close($mysqli);
		}
	}
	else if(isset($_SESSION['email']) && isset($_SESSION['avatar'])){
		$email=$_SESSION['email'];
		$encontrado=3;
	}
	

?> 