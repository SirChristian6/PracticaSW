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
									
									$xml = simplexml_load_file('../xml/Questions.xml');
									
									// Accede a los nodos <puntuacion> de la primera pelicula.
									echo("<table border=1> <tr> <th> E-mail del Autor</th> <th> Pregunta </th> <th> Respuesta </th></tr>");
									foreach ($xml->xpath('//assessmentItem') as $assessmentItem) {
										echo  utf8_decode("<tr> <td> $assessmentItem[author] </td>"); 
										$pregunta=$assessmentItem->itemBody;
										echo  utf8_decode(" <td> $pregunta->p </td>"); 
										$respuesta=$assessmentItem->correctResponse;
										echo utf8_decode("<td> $respuesta->value </td> </tr>");

									}
									echo '</table>';

								}
								else{
									$sql->close();
								}
							}
							mysqli_close($mysqli);	
						}
					}
					if(!$encontrado){
						header("location: Layout.php");
					}
				?>
		    </div>
		</section>
		<?php include '../html/Footer.html' ?>
	</body>
</html>