<!DOCTYPE html>
<html>
	<head>
	  <?php include '../html/Head.html'?>
	</head>
	<body>
		<?php include '../php/Menus.php' ?>
		<section class="main" id="s1">
		    <div>
		    	<h2>FORMULARIO PARA AÑADIR PREGUNTA</h2><br>
				<div style="text-align: left; margin-left: 15%; font-size: 20px ;">
					<?php
						$encontrado=false;
						if(isset($_GET['email'])){
							include "DbConfig.php";
							$email=$_GET['email'];
				  			$mysqli=mysqli_connect($server,$user,$pass,$basededatos);
				  			if($mysqli){
								$sql = mysqli_query($mysqli, "SELECT email FROM usuarios" );
								if($sql){
									while( $usuarios=mysqli_fetch_array($sql)){
										if( strcmp($usuarios['email'], $email)==0 ){
											$encontrado=true;
											break;
										}
									}
									if($encontrado){
								    	echo("<form id='fquestion' name='fquestion' action='AddQuestion.php?email=".$_GET['email']."' method='POST'> 	 <strong>E-mail de la UPV/EHU*:</strong> 
								    			<input type='text' id='email' name='email' value='".$_GET['email']."' readonly><br><br>
								    			<strong>Enunciado de la pregunta*:</strong> 	
								    			<input type='text' id='pregunta' name='pregunta'><br><br>
								    			<strong>Respuesta correcta*:</strong> 		
								    			<input type='text' id='respc' 	 name='respc'><br><br>
								    			<strong>Respuesta incorrecta 1*:</strong>	
								    			<input type='text' id='resp1' 	 name='resp1'><br><br>
								    			<strong>Respuesta incorrecta 2*:</strong>	
								    			<input type='text' id='resp2' 	 name='resp2'><br><br>
								    			<strong>Respuesta incorrecta 3*:</strong>	
								    			<input type='text' id='resp3' 	 name='resp3'><br><br>
								    			<strong>Complejidad de la pregunta:</strong>
								    			<select id='comp' name='comp' size='1'>
								    				<option value='1'>Baja</option>
								    				<option value='2'>Media</option>
								    				<option value='3'>Alta</option>
								    			</select><br><br>
								    			<strong>Tema de la pregunta*:</strong><input type='text' id='tema' name='tema'><br><br>
								    			<input type='submit' value='Enviar' id='enviar'>
								    		</form>");
						        	}
						        	$sql->close();
						        }
								mysqli_close($mysqli);
							}
			        	}
			        	if(!$encontrado){
							echo("<script> location.href='Layout.php';</script>");
						}
			        ?>
				</div>
		    </div>
		</section>
		<?php include '../html/Footer.html' ?>
		<script src="../js/jquery-3.4.1.min.js"></script>
		<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
	</body>
</html>
