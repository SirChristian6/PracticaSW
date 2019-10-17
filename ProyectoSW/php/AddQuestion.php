<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

		<?php 
			include "DbConfig.php";
			if(isset($_POST['email'])){
			    $mysqli=mysqli_connect($server,$user,$pass,$basededatos);
			}
            else{
                die("<h2> Lo siento, no se ha recibido ningún dato, vuelva a intentarlo o pruebe más tarde.</h2></br>
					  <h2> Disculpe las molestias causadas.</h2></br>
					  <a href='QuestionForm.php'> Ir a Insertar Pregunta </a>");
            }

			if(!$mysqli){
				
				die ("<h2> Lo siento, no se ha podido insertar su pregunta, vuelva a intentarlo o pruebe más tarde.</h2></br>
					  <h2> Disculpe las molestias causadas.</h2></br> 
					  <a href='QuestionForm.php'> Volver a Insertar Pregunta </a>");
			}

			$sql="INSERT INTO preguntas (email,pregunta,respcor,respinc1,respinc2,respinc3,complejidad,tema) VALUES ('$_POST[email]','$_POST[pregunta]','$_POST[respc]','$_POST[resp1]','$_POST[resp2]','$_POST[resp3]','$_POST[comp]','$_POST[tema]')";

			if (!mysqli_query($mysqli ,$sql)){
				die ("<h2> Lo siento, no se ha podido insertar su pregunta, vuelva a intentarlo o pruebe más tarde.</h2></br>
					  <h2> Disculpe las molestias causadas.</h2></br> 
					  <a href='QuestionForm.php'> Volver a Insertar Pregunta </a>");
			}
			echo "<h2> Pregunta añadida correctamente </h2>";
			echo "<p> <a href='ShowQuestions.php'> Ver Preguntas </a>";
			mysqli_close($mysqli); 
		?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
