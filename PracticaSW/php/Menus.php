<div id='page-wrap'>
<header class='main' id='h1'>
	<?php
		if($encontrado!=0){
			echo("<span class='right'><a id='logout' href='DecreaseGlobalCounter.php'>Logout</a></span> ");
			echo($email);
			echo(" <img id='imagen' name='imagen' width='100' src='../images/".$usuarios['avatar']."'> ");
		}
		else {
			echo("<span class='right'><a href='SignUp.php'>Registro</a></span>");
	    	echo("<span class='right'><a href='LogIn.php'>Login</a></span>");
		}
    ?>
</header>
<nav class='main' id='n1' role='navigation'>	
  	<?php
  		echo("<span><a href='Layout.php'>Inicio</a></span>");
		echo("<span><a href='Credits.php'>Creditos</a></span>");
		if($encontrado==2){//Pofesores y alumnos
			echo("<span><a href='HandlingQuizesAjax.php'> Gestionar Preguntas</a></span>");
			echo("<span><a href='ClientGetQuestion.php'> Ver Datos Pregunta</a></span>");
		}
		else if($encontrado==1){//admin
			echo("<span><a href='HandlingAccounts.php'> Gestionar Usuarios</a></span>");
		}
  	?>
</nav>