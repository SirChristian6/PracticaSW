<?php 
	session_start();
	session_destroy();
	echo("<script> alert('Sesión cerrada correctamente');");
	echo("location.href='Layout.php';</script>");
?>