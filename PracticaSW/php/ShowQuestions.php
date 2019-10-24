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
			$encontrado=false;
	  		if(isset($_GET['email'])){

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
							$usuarios = mysqli_query($mysqli, "SELECT email,pregunta,respcor FROM preguntas" );
							if($usuarios){
								echo ("<table border=1> <tr> <th> E-mail del Autor</th> <th> Pregunta </th> <th> Respuesta </th></tr>");
								while ($row = mysqli_fetch_array( $usuarios )) {
									echo ("<tr> <td>" . $row['email'] ."</td> <td>" . $row['pregunta'] ."</td> <td>" . $row['respcor'] ."</td> </tr>");
								}
								echo '</table>';
								$usuarios->close();
							}
							else{

								echo("<br><h3> Lo siento, no se han podido visualizar las preguntas, vuelva a intentarlo o pruebe más tarde.</h3></br>
								  <h3> Disculpe las molestias causadas.</h3></br>");
							}
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
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
