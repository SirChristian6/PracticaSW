<?php include '../php/Security.php' ?>
<!DOCTYPE html>
<html>
<head>
  	<?php include '../html/Head.html'?>
</head>
<body>
  	<?php include '../php/Menus.php' ?>
  	<section class='main' id='s1' style='overflow-y: scroll;'>
    	<div>

		
	    	<h2>Registrar Nuevo Usuario</h2><br>
			<div style='text-align: left; margin-left: 15%; font-size: 20px ;'>

			    <form id='flogin' name='flogin' method='POST' enctype='multipart/form-data'>
		            <strong>E-mail de la UPV/EHU*:</strong> 		
		            <input type='text' id='email' name='email' onchange='verifyVip()' autofocus> <span id='response1'></span><br><img id='vip' width='100'/><br><br>

		            <strong>Tipo de Usuario:</strong>
		            <select id='tusr' name='tusr' size='1'>
			            <option value='alumno'>Alumno</option>
			            <option value='profesor'>Profesor</option>
		            </select><br><br>

		            <strong>Nombre y apellidos*:</strong> 	
		            <input type='text' id='nomap' name='nomap'><br><br>

		            <strong>Contraseña*:</strong> 			
		            <input type='password' id='pass1' name='pass1' onchange='verifyPassword()'><span id='response2'></span><br><img id='verpas' width='100'/><br><br>

		            <strong>Repetir Contraseña*:</strong>	
		            <input type='password' id='pass2' name='pass2'><br><br>

		            <strong>Avatar*:</strong>				
		            <input type='file' id='foto' name='foto' accept='image/*' onchange='verImagen(event)'><br><br>
		            <img id='imagen' name='imagen' width='100' ><br> 

		            <input type='submit' value='Registrarse' id='regis' disabled='true'>
		        </form>
		        <script src="../js/jquery-3.4.1.min.js"></script>
		        <script src="../js/ValidateVipPass.js"></script>
		        <script type='text/javascript'>
		        	function verImagen(event){
		        		$("#imagen").attr("src",URL.createObjectURL(event.target.files[0]));
		        	};
		        </script>


		       <?php 
    				if($encontrado==0){
    					include "DbConfig.php";
    					if(isset($_POST['email'])&&isset($_POST['tusr'])&&isset($_POST['nomap'])&&isset($_POST['pass1'])&&isset($_POST['pass2'])){
    						$err=false;
    						if( !( preg_match("/^[a-z]+([0-9]{3}@ikasle\.|(\.[a-z]+)?@)ehu\.(eus|es)$/",$_POST['email']) ) ){
    							$err=true;
    			    		}
    			    		else if(strcmp($_POST['email'],'admin@ehu.es')==0&&strcmp($_POST['tusr'],'profesor')!=0){
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
    									$existe=false;
    									while( $usuarios=mysqli_fetch_array($sql)){
    										if( strcmp($usuarios['email'], $_POST['email'])==0 ){
    											$existe=true;
    											break;
    										}
    									}
    									if(!$existe){
    										$imagen=$_POST['email'].$_FILES['foto']['name'];
    										$imagenTMP=$_FILES['foto']['tmp_name'];
    										$carpeta="/storage/ssd3/213/10925213/public_html/PracticaSW/images/";
    										move_uploaded_file($imagenTMP, $carpeta.$imagen);
    										if(strcmp($_POST['email'],'admin@ehu.es')==0){
    											$tusr="admin";
    										}
    										else{
    											$tusr=$_POST['tusr'];
    										}
    										
    										$password=crypt($_POST['pass1'],'$1$5ECRE705$');
    										$sql="INSERT INTO usuarios (email,nombre,apellidos,rol,password,avatar,estado) VALUES ('$_POST[email]','$nombre','$apellidos','$tusr','$password','../images/$imagen','activado')";
    
    										if (mysqli_query($mysqli ,$sql)){
    											mysqli_close($mysqli);
    											echo("<script> alert('Usted se ha registrado correctamente');</script>");
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