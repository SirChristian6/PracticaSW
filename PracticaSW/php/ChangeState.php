<?php include '../php/Security.php' ?>
<?php
	if($encontrado==1){
		if(isset($_GET['email'])){
		    if(strcmp($_GET['email'],"admin@ehu.es")!=0){
    			include "DbConfig.php";
    			$mysqli=mysqli_connect($server,$user,$pass,$basededatos);		
    			if($mysqli){
    				$sql=mysqli_query($mysqli, "SELECT estado FROM usuarios WHERE email='$_GET[email]'" );
    				if($sql){
    					$estado=mysqli_fetch_array($sql);
    					if(strcmp($estado['estado'],"activado")==0){
    						mysqli_query($mysqli, "UPDATE usuarios SET estado='bloqueado' WHERE email='$_GET[email]'" );
    					}
    					if(strcmp($estado['estado'],"bloqueado")==0){
    						mysqli_query($mysqli, "UPDATE usuarios SET estado='activado' WHERE email='$_GET[email]'" );
    					}
    				}
    				mysqli_close($mysqli);
    			}
		    }
		}
		echo("<script>location.href='HandlingAccounts.php';</script>");
	}
	else if($encontrado==2){
		echo("<script>alert('Lo sentimos, pero como Profesor/Alumno no tiene permiso para gestionar las cuentas');</script>");
		echo("<script>location.href='Layout.php';</script>");
	}
	else if($encontrado==3){
		echo("<script>alert('Lo sentimos, pero como invitado no tiene permiso para gestionar las cuentas');</script>");
		echo("<script>location.href='Layout.php';</script>");
	}
	else{
		echo("<script>location.href='Layout.php';</script>");
	}
?>