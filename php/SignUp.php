<!DOCTYPE html>
<html>
<head>
  	<?php include '../html/Head.html'?>
</head>
<body>
  	<?php include '../php/Menus.php' ?>
  	<section class='main' id='s1'>
    	<div>

		
	    	<h2>Registrar Nuevo Usuario</h2><br>
			<div style='text-align: left; margin-left: 15%; font-size: 20px ;'>

			    <form id='flogin' name='flogin' method='POST' enctype='multipart/form-data'>
		            <strong>E-mail de la UPV/EHU*:</strong> 		
		            <input type='text' id='email' 	 name='email'><br><br>

		            <strong>Tipo de Usuario*:</strong>
		            <select id='tusr' name='tusr' size='1'>
			            <option value='alumno'>Alumno</option>
			            <option value='profesor'>Profesor</option>
		            </select><br><br>

		            <strong>Nombre y apellidos*:</strong> 	
		            <input type='text' id='nomap' name='nomap'><br><br>

		            <strong>Contraseña*:</strong> 			
		            <input type='password' id='pass1' 	 name='pass1'><br><br>

		            <strong>Repetir Contraseña*:</strong>	
		            <input type='password' id='pass2' 	 name='pass2'><br><br>

		            <strong>Avatar*:</strong>				
		            <input type='file' id='foto' name='foto' accept='image/*' onchange='verImagen(event)'><br><br>
		            <img id='imagen' name='imagen' width='100' ><br> 

		            <input type='submit' value='Registrarse' id='regis'>
		        </form>
		        <script src="../js/jquery-3.4.1.min.js"></script>
		        <script type='text/javascript'>
		        	function verImagen(event){
		        		$("#imagen").attr("src",URL.createObjectURL(event.target.files[0]));
		        	};
		        </script>

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
										echo("<script> location.href='Layout.php?email=".$email."';</script>");
									}
								}
								$sql->close();
							}
							mysqli_close($mysqli);
						}
					}
					
					if(isset($_POST['email'])&&isset($_POST['tusr'])&&isset($_POST['nomap'])&&isset($_POST['pass1'])&&isset($_POST['pass2'])){
						$err=false;
						if( !( preg_match("/^[a-z]+([0-9]{3}@ikasle\.|(\.[a-z]+)?@)ehu\.(eus|es)$/",$_POST['email']) ) ){
							$err=true;
			    		}
						else if( !( strcmp($_POST['tusr'],'profesor')==0 || strcmp($_POST['tusr'],'alumno')==0 ) ){
							$err=true;
						}
						else if( !( strlen($_POST['pass1'])>=6 ) ){
							$err=true;
						}
						else if( !( strlen($_POST['pass2'])>=6 ) ){
							$err=true;
						}
						else if( !( strcmp($_POST['pass1'],$_POST['pass2'])==0 ) ){
							$err=true;
						}
						else if( !( strlen($_POST['nomap'])>0 ) ){
							$err=true;
						}
						else if(!$err){
							$string=trim($_POST['nomap']);
							$token = strtok($string, " ");
							$nombre=$token;
							$apellidos="";

							while (($token=strtok(" ")) !== false){
								$apellidos=$apellidos." ".$token;
							}
							if($apellidos==""){
								$err=true;
							}
						}
						if (empty($_FILES['foto']['name'])){
							$err=true;
						}

						
						if(!$err){
							$mysqli=mysqli_connect($server,$user,$pass,$basededatos);		
							if($mysqli){
								$sql = mysqli_query($mysqli, "SELECT email FROM usuarios" );
								if($sql){
									$encontrado=false;
									while( $usuarios=mysqli_fetch_array($sql)){
										if( strcmp($usuarios['email'], $_POST['email'])==0 ){
											$encontrado=true;
											break;
										}
									}
									if(!$encontrado){

										$imagen=$_POST['email'].$_FILES['foto']['name'];
										$imagenTMP=$_FILES['foto']['tmp_name'];
										$carpeta="/storage/ssd3/213/10925213/public_html/PracticaSW/images/";
										move_uploaded_file($imagenTMP, $carpeta.$imagen);


										$sql="INSERT INTO usuarios (email,nombre,apellidos,dedicacion,password,avatar) VALUES ('$_POST[email]','$nombre','$apellidos','$_POST[tusr]','$_POST[pass1]','$imagen')";

										if (mysqli_query($mysqli ,$sql)){
											mysqli_close($mysqli);
											echo("<script> location.href='LogIn.php';</script>");
										}
										else{
											echo("<br><h3> Lo siento, no se ha podido realizar su registro, vuelva a intentarlo o pruebe más tarde.</h3></br>
											  	<h3> Disculpe las molestias causadas.</h3></br>");
										}
									}
									else{
									    $sql->close();
										echo("<br><h3> Lo siento, ya existe una cuenta registrada con este email.</h3></br>
											  <a href='LogIn.php'> Iniciar sesion </a>");
									}
								}
								else{
								    mysqli_close($mysqli);
									echo("<br><h3> Lo siento, no se ha podido realizar su registro, vuelva a intentarlo o pruebe más tarde.</h3></br>
								  		<h3> Disculpe las molestias causadas.</h3></br>");
								}
								
							}
							else{
								echo("<br><h3> Lo siento, no se ha podido realizar su registro, vuelva a intentarlo o pruebe más tarde.</h3></br>
								  <h3> Disculpe las molestias causadas.</h3></br>");
							}
						}
			            else{
			                echo("<br><h3> Lo siento, faltan datos por introducir o no son correctos</h3>");
			            }						
					}
				
				?>
    		</div>
  		</section>
  		<?php include '../html/Footer.html' ?>
	</body>
</html>
