<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            alert('CERRADO');
            
        });
        
    }
    function onSignIn(googleUser){
        var profile=googleUser.getBasicProfile();
        signOut();
        location.href='LoginSocial.php?email='+profile.getEmail()+'&avatar='+profile.getImageUrl();
    }
    
</script>
<meta name="google-signin-client_id" content="420403756674-b8ur9tmj4rr64uob1cra28g1pebr6n22.apps.googleusercontent.com">
<div id='page-wrap'>
<header class='main' id='h1'>
	<?php
		if($encontrado!=0){
		    if($encontrado==3){
		        //echo("<span class='right'><button onclick='signOut();'>Logout</button></span> ");
		        echo("<span class='right'><a id='logout' href='DecreaseGlobalCounter.php'>Logout</a></span> ");
		    }
		    else{
		        echo("<span class='right'><a id='logout' href='DecreaseGlobalCounter.php'>Logout</a></span> ");
		    }
			echo($email);
			echo(" <img id='imagen' name='imagen' width='100' src='".$_SESSION['avatar']."'> ");
		}
		else {
			echo("<span class='right'><a href='SignUp.php'>Registro</a> </span>");
	    	echo("<span class='right'><a href='LogIn.php'>Login</a> </span>");
	    	echo("<span class='right'><a href='CambiarPass1.php'>Cambiar Contraseña</a></span>");
	    	echo("<span class='g-signin2' data-onsuccess='onSignIn'></span>");
		}
    ?>
</header>
<nav class='main' id='n1' role='navigation'>	
  	<?php
  		echo("<span><a href='Layout.php'>Inicio</a></span>");
		echo("<span><a href='Credits.php'>Creditos</a></span>");
		if($encontrado==2||$encontrado==3){//Pofesores y alumnos
			echo("<span><a href='HandlingQuizesAjax.php'> Gestionar Preguntas</a></span>");
			echo("<span><a href='ClientGetQuestion.php'> Ver Datos Pregunta</a></span>");
		}
		else if($encontrado==1){//admin
			echo("<span><a href='HandlingAccounts.php'> Gestionar Usuarios</a></span>");
		}
  	?>
</nav>
