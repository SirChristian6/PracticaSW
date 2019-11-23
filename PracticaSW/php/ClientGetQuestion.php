<?php include '../php/Security.php' ?>
<!DOCTYPE html>
<html>
	<head>
	  <?php include '../html/Head.html'?>
	  <script src="../js/jquery-3.4.1.min.js"></script>
	</head>
	<body >
		<?php include '../php/Menus.php' ?>
		
		<section class="main" id="s1" class="main" id="s1" style="overflow-y: scroll;">
		    <div style="text-align: left; margin-left: 15%; font-size: 20px ;">
		    	<?php
		    		if($encontrado==2){
						echo("<form name='datos' id='datos' method='POST'>
								<strong>Identificador de la pregunta</strong> <input type='text' id='ident' name='ident'></input>
								<input type='submit' name='buscar' value='Buscar Pregunta'></input>
							  </form><br>
							  <div id='response'></div>
						      <strong>Autor:</strong>
							  <input type='text' id='email' readonly><br><br>
							  <strong>Pregunta:</strong>	
				    		  <input type='text' id='pregunta' readonly><br><br>
				    		  <strong>Respuesta correcta:</strong> 		
				    		  <input type='text' id='respc' readonly><br><br>"
				    	);
						
						if (isset($_POST['ident'])){

							
							require_once('../lib/nusoap.php');
							require_once('../lib/class.wsdlcache.php');
							
							$soapclient = new nusoap_client('https://sistemaswebchernandez.000webhostapp.com/PracticaSW/php/GetQuestionWS.php?wsdl',true);
							
							$result=$soapclient->call('ObtenerPregunta',array( 'id'=>$_POST['ident']));
						
							echo("<script>
									$('#ident').val(".$_POST['ident'].")
									$('#email').val('".$result['email']."');
									$('#pregunta').val('".$result['enunciado']."');
									$('#respc').val('".$result['respuesta']."');
								</script>"
							);
							
							//echo($result);
							if(strcmp($result['email'],"")==0){
								echo("<script> $('#response').html('No existe la pregunta cuyo identificador sea: ".$_POST['ident']."<br><br>');
									</script>"
								);
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
			</div>
		</section>
		<?php include '../html/Footer.html' ?>
		
		
	</body>
</html>