<?php include '../php/Security.php' ?>
<?php 

	if($encontrado==2){
		if(isset($_POST['email']) && isset($_POST['pregunta']) && isset($_POST['respc']) && isset($_POST['resp1']) && isset($_POST['resp2']) && isset($_POST['resp3']) && isset($_POST['comp']) && isset($_POST['tema'])){
					
			$err=false;

			if( !(preg_match("/^[a-z]+([0-9]{3}@ikasle\.|(\.[a-z]+)?@)ehu\.(eus|es)$/",$_POST['email']) ) ){
				$err=true;
    		}
			else if( !( strlen($_POST['pregunta'])>=10 ) ){
				$err=true;
			}
			else if( !( strlen($_POST['respc'])>0 ) ){
				$err=true;
			}
			else if( !( strlen($_POST['resp1'])>0 ) ){
				$err=true;
			}
			else if( !( strlen($_POST['resp2'])>0 ) ){
				$err=true;
			}
			else if( !( strlen($_POST['resp3'])>0 ) ){
				$err=true;
			}
			else if( !( strlen($_POST['comp'])>0 ) ){
				$err=true;
			}
			else if( !( strcmp($_POST['comp'], '1')==0 || strcmp($_POST['comp'],'2')==0 ||strcmp($_POST['comp'],'2')==0)){
				$err=true;
			}
			else if( !( strlen($_POST['tema'])>0 ) ){
				$err=true;
			}

			if(!$err){
				
				include "DbConfig.php";
				$mysqli=mysqli_connect($server,$user,$pass,$basededatos);
				if($mysqli){
					$sql="INSERT INTO preguntas (email,pregunta,respcor,respinc1,respinc2,respinc3,complejidad,tema) VALUES ('$_POST[email]','$_POST[pregunta]','$_POST[respc]','$_POST[resp1]','$_POST[resp2]','$_POST[resp3]','$_POST[comp]','$_POST[tema]')";

					if (mysqli_query($mysqli ,$sql)){
						$xml = simplexml_load_file('../xml/Questions.xml');
						$pregunta = $xml->addChild('assessmentItem');
						$pregunta->addAttribute('subject', $_POST['tema']);
						$pregunta->addAttribute('author', $_POST['email']);
							$itemBody=$pregunta->addChild('itemBody');
								$itemBody->addChild('p',$_POST['pregunta']);
							$correctResponse=$pregunta->addChild('correctResponse');
								$correctResponse->addChild('value',$_POST['respc']);
							$incorrectResponses=$pregunta->addChild('incorrectResponses');
								$incorrectResponses->addChild('value',$_POST['resp1']);
								$incorrectResponses->addChild('value',$_POST['resp2']);
								$incorrectResponses->addChild('value',$_POST['resp3']);
						$xml->asXML('../xml/Questions.xml');
						echo "<h3> Pregunta añadida correctamente </h3>";
						
					}
					else{
						echo("<h3 id='ErrorMsgs'> Lo siento, no se ha podido insertar su pregunta, vuelva a intentarlo o pruebe más tarde.</h3></br>
							  <h3> Disculpe las molestias causadas.</h3></br>");
					}
					mysqli_close($mysqli);	
				}
				else{
					echo("<h3 id='ErrorMsgs'> Lo siento, no se han recibido bien los datos, vuelva a intentarlo o pruebe más tarde.</h3></br>
				 		<h3> Disculpe las molestias causadas.</h3></br>
				 	");
				}
			}
            else{
                echo("<h3 id='ErrorMsgs'> Lo siento, los datos introducidos no son válidos</h3></br>");
            } 
		}	
	}
	else if($encontrado==1){
		echo("<script>alert('Lo sentimos, pero como administrador no tiene permiso para gestionar las preguntas');</script>");
		echo("<script>location.href='Layout.php';</script>");
	}
	else{
		echo("<script>location.href='Layout.php';</script>");
	}
?>