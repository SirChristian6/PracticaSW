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

		    <form id='fquestion' name='fquestion' action=’AddQuestion.php’>
	            <strong>E-mail de la UPV/EHU*:</strong> 		<input type="text" id="email" 	 name="email"><br><br>
	            <strong>Enunciado de la pregunta*:</strong> 	<input type="text" id="pregunta" name="pregunta"><br><br>
	            <strong>Respuesta correcta*:</strong> 		<input type="text" id="respC" 	 name="respC"><br><br>
	            <strong>Respuesta incorrecta 1*:</strong>	<input type="text" id="resp1" 	 name="resp1"><br><br>
	            <strong>Respuesta incorrecta 2*:</strong>	<input type="text" id="resp2" 	 name="resp2"><br><br>
	            <strong>Respuesta incorrecta 3*:</strong>	<input type="text" id="resp3" 	 name="resp3"><br><br>
	            <strong>Complejidad de la pregunta:</strong>
	            	<select id="comp" name="comp" size="1">
		                <option value="1">Baja</option>
		                <option value="2">Media</option>
		                <option value="3">Alta</option>
	                </select><br><br>
	            <strong>Tema de la pregunta*:</strong><input type="text" id="tema" name="tema"><br><br>
	            <input type="submit" onclick="comprobar()" value="Enviar" id="enviar">
	        </form>

		</div>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="../js/ValidateFieldsQuestion.js"></script>
</body>
</html>
