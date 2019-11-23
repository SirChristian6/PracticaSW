<?php include '../php/Security.php' ?>
<!DOCTYPE html>
<html>
	<head>
	  	<?php include '../html/Head.html'?>
	</head>
	<body>
	  	<?php include '../php/Menus.php' ?>
	  	<section class="main" id="s1">
	  		<?php
	  			if($encontrado==1){
	  				include "DbConfig.php";
	  				$mysqli=mysqli_connect($server,$user,$pass,$basededatos);		
					if($mysqli){
						$sql = mysqli_query($mysqli, "SELECT email,password,avatar,estado FROM usuarios" );
						if($sql){
							echo("<table border=1>
								<tr><th>E-mail</th><th>Contraseña</th><th>Foto</th><th>Estado</th><th>Cambiar Estado</th><th>Eliminar</th></tr>");
							$num=0;
							$script="";
							while( $usuarios=mysqli_fetch_array($sql)){
								echo("<tr>
										<td>$usuarios[email]</td>
										<td>$usuarios[password]</td>
										 
										<td><img width='100' heigth='100' src='../images/$usuarios[avatar]'></td>
										<td>$usuarios[estado]</td>
										<td><input type='button' value='Cambiar Estado' onclick='cambiarEstado(&quot;".$usuarios['email']."&quot;)'></td>
										<td><input type='button'  value='Borrar Usuario' onclick='borrarUsuario(&quot;".$usuarios['email']."&quot;)'></td>
									</tr>
									");
								$num++;
							}
							echo("</table>");
							$sql->close();

						}
					}
	  			}
	  			else if($encontrado==2){
	  				echo("<script>alert('Lo sentimos, pero como Profesor/Alumno no tiene permiso para gestionar las cuentas');</script>");
					echo("<script>location.href='Layout.php';</script>");
	  			}
	  			else{
					echo("<script>location.href='Layout.php';</script>");
	  			}
	  		?>
	  	</section>
	  	<?php include '../html/Footer.html' ?>
	  	<script src="../js/jquery-3.4.1.min.js"></script>
	  	<script src="../js/HandlingAccounts.js"></script>
	</body>
</html>