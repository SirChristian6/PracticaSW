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
		    <div >
		    	<h2>FORMULARIO PARA AÑADIR PREGUNTA</h2><br>
				<div style="text-align: left; margin-left: 15%; font-size: 20px ;">
					<?php
						if($encontrado==2){//profesor o alumno
					    	echo("

					    		<div>
					    		<h3 >Usuarios Modificando Preguntas:</h3><div id='usuarios'></div><br>
					    		<h3 >Mis preguntas/Todas las preguntas:</h3><p id='contador'></p><br>
					    		</div>
					    		<form id='fquestion' name='fquestion' method='POST'> 	 
					    			<strong>E-mail de la UPV/EHU*:</strong> 
					    			<input type='text' id='email' name='email' value='".$email."' readonly><br><br>
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
					   				<input type='button' value='Insertar Pregunta' id='insertar' onclick='validar()'>
					    			<input type='button' value='Ver Preguntas' id='ver' onclick ='verPreguntas()'>
					    			<input type='reset' value='Vaciar Formulario' id='vaciar'>
					    		</form><br>

					    		<div id='respuestaServ'></div>
					    		<div id='preguntas'></div>
					    		");
						        	
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
		    </div>
		</section>
		<?php include '../html/Footer.html' ?>
		
		<script src="../js/ValidateFieldsQuestions.js"></script>
		<script src="../js/ShowQuestionsAjax.js"></script>
		<script src="../js/AddQuestionsAjax.js"></script>
		<script src="../js/CountQuestionsAjax.js"></script>
		<script src="../js/CountUsersAjax.js"></script>
		<script>

			$('#usuarios').html("<div><img src='../images/pokeball.gif' width='100'/></div>");
			$('#contador').html("<div><img src='../images/circle.gif' width='100'/></div>");
			setInterval(numPreguntas,11000);
			setInterval(numUsers,11000);
			$("#vaciar").click(function (){
				$("#respuestaServ").html("");
				$("#preguntas").html("");
			});
		</script>
		
	</body>
</html>