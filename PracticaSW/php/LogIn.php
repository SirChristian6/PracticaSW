<?php include '../php/Security.php' ?>
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
		            <span><a href='CambiarPass1.php'>¿Ha olvidado su contraseña?</a></span><br>
		            <input type="submit" value="Entrar" id="entrar">
		        </form>
		    </div>

		  	<?php
		  	
    			include "DbConfig.php";
    			if($encontrado==0){
    		  		if(isset($_POST['email'])&&isset($_POST['passwd'])){ //Comprobar si se han enviado los datos
    		  			
    					$mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Crear conexión con la BD
    					if($mysqli){
    						
    						$sql = mysqli_query($mysqli, "SELECT email,password,estado,rol FROM usuarios" ); //Sentencia SQL para conseguir los emails y contraseñas
    
    						if ($sql){
    							$email=$_POST['email'];
    		  					$password=crypt($_POST['passwd'],'$1$5ECRE705$');
    							$existe=false;
    
    							while( $usuarios=mysqli_fetch_array($sql) ){ //Comparar email y contraseña introducidos con los de la BD
    								if( strcmp($usuarios['email'], $email)==0 &&  strcmp($usuarios['password'], $password)==0 && strcmp($usuarios['estado'], "activado")==0){
    									$existe=true;
    									$_SESSION['email']=$email;
              							$_SESSION['passwd']=$password;
    									break;
    								}
    							}
    
    							$sql->close();
    							mysqli_close($mysqli);
    
    							if($existe){
    								if(strcmp($usuarios['rol'],"admin")!=0){
    							        echo("<script>alert('Bienvenido'); location.href='IncreaseGlobalCounter.php';</script>");
    								}
    								else{
    								    echo("<script>location.href='Layout.php';</script>");
    								}
    							}
    							else{
    								echo("<h3 style='color:red'> Lo siento, no se ha podido iniciar sesion, Email y/o Contraseña incorrectas o su acceso esta restringido.</h3></br>");
    							}
    						}
    						else{
    						    mysqli_close($mysqli);
    							echo("<h3> Lo siento, no se ha podido iniciar sesion, vuelva a intentarlo o pruebe más tarde.</h3></br>
    								  <h3> Disculpe las molestias causadas.</h3></br>");
    						}
    					}
    					else{
    						echo("<h3> Lo siento, no se ha podido iniciar sesion, vuelva a intentarlo o pruebe más tarde.</h3></br>
    							  <h3> Disculpe las molestias causadas.</h3></br>");
    					}
    				}
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