<!DOCTYPE html>
<html>
<head>
  	<?php include '../html/Head.html'?>
</head>
<body>
  	<?php include '../php/Menus.php' ?>
  	<section class="main" id="s1">
	    <div>

	    	<h2>Iniciar Sesión</h2><br>
			<div style="text-align: left; margin-left: 15%; font-size: 20px ;">

			    <form id="fquestion" name="fquestion" method="POST" >
		            <strong>E-mail de la UPV/EHU:</strong> 		<input type="text" id="email" 	 name="email"><br><br>
		            <strong>Contraseña:</strong> 	<input type="password" id="passwd" name="passwd"><br><br>
		            
		            <input type="submit" value="Entrar" id="entrar">
		        </form>
		    </div>

		  	<?php
				include "DbConfig.php";

				if(isset($_GET['email'])){
			  		$mysqli=mysqli_connect($server,$user,$pass,$basededatos);
			  		if($mysqli){
						$sql = mysqli_query($mysqli, "SELECT email FROM usuarios" );
						if($sql){
							while( $usuarios=mysqli_fetch_array($sql)){
								if( strcmp($usuarios['email'], $email)==0 ){
									$sql->close();
									mysqli_close($mysqli);
									echo("<script>alert('Bienvenido'); location.href='IncreaseGlobalCounter.php?email=".$email."';</script>");
								}
							}
							$sql->close();
						}
						mysqli_close($mysqli);
					}
				}




		  		if(isset($_POST['email'])&&isset($_POST['passwd'])){ //Comprobar si se han enviado los datos

		  			$email=$_POST['email'];
		  			$password=$_POST['passwd'];
		  			
					$mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Crear conexión con la BD
					if($mysqli){
						
						$sql = mysqli_query($mysqli, "SELECT email,password FROM usuarios" ); //Sentencia SQL para conseguir los emails y contraseñas

						if ($sql){

							$encontrado=0;

							while( $usuarios=mysqli_fetch_array($sql) ){ //Comparar email y contraseña introducidos con los de la BD
								if( strcmp($usuarios['email'], $email)==0 &&  strcmp($usuarios['password'], $password)==0){
									$encontrado=1;
									break;
								}
							}

							$sql->close();
							mysqli_close($mysqli);

							if($encontrado==1){
							    echo("<script>alert('Bienvenido'); location.href='IncreaseGlobalCounter.php?email=".$email."';</script>");
							}
							else{
								echo("<h3 style='color:red'> Lo siento, no se ha podido iniciar sesion, Email o Contraseña incorrectas.</h2></br>");
							}
						}
						else{
						    mysqli_close($mysqli);
							echo("<h3> Lo siento, no se ha podido iniciar sesion, vuelva a intentarlo o pruebe más tarde.</h2></br>
								  <h3> Disculpe las molestias causadas.</h2></br>");
						}
						
					}
					else{
						echo("<h3> Lo siento, no se ha podido iniciar sesion, vuelva a intentarlo o pruebe más tarde.</h2></br>
							  <h3> Disculpe las molestias causadas.</h2></br>");
					}
				}
			?>
	    </div>
  	</section>
  	<?php include '../html/Footer.html' ?>
</body>
</html>
