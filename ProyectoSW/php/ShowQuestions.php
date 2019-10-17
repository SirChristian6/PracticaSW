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
			$mysqli=mysqli_connect($server,$user,$pass,$basededatos);
			$usuarios = mysqli_query($mysqli, "select email,pregunta,respcor from preguntas" );
			echo '<table border=1> <tr> <th> E-mail del Autor</th> <th> Pregunta </th> <th> Respuesta </th></tr>';
			while ($row = mysqli_fetch_array( $usuarios )) {
				echo '<tr> <td>' . $row['email'] .'</td> <td>' . $row['pregunta'] .'</td> <td>' . $row['respcor'] .'</td> </tr>';
			}
			echo '</table>';
			$usuarios->close();
			mysqli_close($mysqli);
		?>




    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
