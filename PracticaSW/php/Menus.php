<div id='page-wrap'>
<header class='main' id='h1'>
	<?php
		$encontrado=false;
		if(isset($_GET['email'])){ //Comprobar si la URL contiene un email

	    	$email=$_GET['email'];
  			include "DbConfig.php";
  			$mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Abrir conexion con la BD


  			if($mysqli){
				$sql = mysqli_query($mysqli, "SELECT email,avatar FROM usuarios" ); //Sentencia SQL para conseguir los emails

				if ($sql){
					
					while( $usuarios=mysqli_fetch_array($sql)){	//comparar email de la URL con los existentes en la BD
						if( strcmp($usuarios['email'], $email)==0 ){
							$encontrado=true;
							break;
						}
					}
					if($encontrado){
						echo("<span class='right'><a id='logout' href='DecreaseGlobalCounter.php?email=".$email."'>Logout</a></span> ");
						echo($email);
						echo(" <img id='imagen' name='imagen' width='100' src='../images/".$usuarios['avatar']."'> ");
                        
					}
					$sql->close();
				}
				mysqli_close($mysqli);
			}
			
		}
		if(!$encontrado){
			echo("<span class='right'><a href='SignUp.php'>Registro</a></span>");
	    	echo("<span class='right'><a href='LogIn.php'>Login</a></span>");
		}

    ?>
   

</header>
<nav class='main' id='n1' role='navigation'>
  	
  	<?php
  		$encontrado=false;
  		if(isset($_GET['email'])){
  			$email=$_GET['email'];
  			include "DbConfig.php";
  			$mysqli=mysqli_connect($server,$user,$pass,$basededatos);
  			if($mysqli){
				$sql = mysqli_query($mysqli, "select email from usuarios" );
				if($sql){
					while( $usuarios=mysqli_fetch_array($sql)){
						if( strcmp($usuarios['email'], $email)==0 ){
							$encontrado=true;
							break;
						}
					}
					if($encontrado){
						echo("<span><a href='Layout.php?email=".$email."'>Inicio</a></span>");
						echo("<span><a href='Credits.php?email=".$email."'>Creditos</a></span>");
						echo("<span><a href='HandlingQuizesAjax.php?email=".$email."'> Gestionar Preguntas</a></span>");
					}
					$sql->close();
				}
				mysqli_close($mysqli);
			}
			
		}
		if(!$encontrado){
			echo("<span><a href='Layout.php'>Inicio</a></span>");
			echo("<span><a href='Credits.php'>Creditos</a></span>");
		}
  	?>

</nav>

