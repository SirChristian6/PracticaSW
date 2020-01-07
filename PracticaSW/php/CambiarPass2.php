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
          if($encontrado!=0 || !isset($_GET['email'])){
            echo("<script>location.href='Layout.php';</script>");
          }
        ?>
        <h2>Cambiar Contraseña</h2><br>
        

        <?php
          if(isset($_POST['email'])&&isset($_POST['pass1'])&&isset($_POST['pass2'])&&isset($_POST['cod'])){

            $email=$_POST['email'];
            $cod=$_POST['cod'];
            $existe=false;
            $err=false;
            include "DbConfig.php";
            $mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Abrir conexion con la BD
            if($mysqli){
              $sql = mysqli_query($mysqli, "SELECT email,codigo,intentosFallidos FROM cambiarpass" ); //Sentencia SQL para conseguir los emails
              if ($sql){
                while( $usuarios=mysqli_fetch_array($sql) ){  //comparar email de la URL con los existentes en la BD
                  if( strcmp($usuarios['email'], $email)==0 && $usuarios['codigo']==$cod && $usuarios['intentosFallidos']<3){
                    $intentosFallidos=$usuarios['intentosFallidos']+1;
                    mysqli_query($mysqli, "UPDATE cambiarpass SET intentosFallidos='$intentosFallidos' WHERE email='$email'" );
                    $existe=true;
                    break;
                  }
                  else if(strcmp($usuarios['email'], $email)==0 && $usuarios['codigo']!=$cod){
                    $intentosFallidos=$usuarios['intentosFallidos']+1;
                    if($intentosFallidos==3){
                      mysqli_query($mysqli, "DELETE FROM cambiarpass WHERE email='$email'" );
                      echo("<br><h3> Lo siento, pero a ustéd no le quedan intentos para cambiar la contraseña, vuelva a hacer una nueva solicitud de cambio de contraseña </h3>");
                      echo("<script>alert('Lo siento, pero a ustéd no le quedan intentos para cambiar la contraseña, vuelva a hacer una nueva solicitud de cambio de contraseña'); location.href='CambiarPass1.php';</script>");
                      
                    }
                    else{
                      $existe=true;
                      $err=true;
                      mysqli_query($mysqli, "UPDATE cambiarpass SET intentosFallidos='$intentosFallidos' WHERE email='$email'" );
                    }
                    break;
                    
                  }
                }
                $sql->close();
                if($existe){
                  
                  if( !( strlen($_POST['pass1'])>=6 ) ){
                    $err=true;
                  }
                  else if( !( strlen($_POST['pass2'])>=6 ) ){
                    $err=true;
                  }
                  else if( !( strcmp($_POST['pass1'],$_POST['pass2'])==0 ) ){
                    $err=true;
                  }
                  if(!$err){
                    mysqli_query($mysqli, "DELETE FROM cambiarpass WHERE email='$email'" );
                    $password=crypt($_POST['pass1'],'$1$5ECRE705$');
                    mysqli_query($mysqli, "UPDATE usuarios SET password='$password' WHERE email='$email'" );
                    echo("<script>alert('La contraseña se ha cambiado exitosamente'); location.href='Layout.php';</script>");
                  }
                  else{
                    echo("<br><h3> Lo siento, faltan datos por introducir o no son correctos</h3>");
                  }
                }
                else{
                  mysqli_close($mysqli);
                  echo("<script>alert('Lo siento, no existen peticiones de cambio de contraseña para esta cuenta'); location.href='Layout.php';</script>");
                }
              }
              mysqli_close($mysqli);
            }
          }

          if(isset($_GET['email'])){
            $email=$_GET['email'];
            $existe=0;
            include "DbConfig.php";
            $mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Abrir conexion con la BD
            if($mysqli){
              $sql = mysqli_query($mysqli, "SELECT email,intentosFallidos FROM cambiarpass" ); //Sentencia SQL para conseguir los emails
              if ($sql){
                while( $usuarios=mysqli_fetch_array($sql) ){  //comparar email de la URL con los existentes en la BD
                  if( strcmp($usuarios['email'], $email)==0){
                    $existe=1;
                    $intentos=$usuarios['intentosFallidos'];
                    break;
                  }
                }
                $sql->close();
              }
              mysqli_close($mysqli);
            }
            if($existe==1){
              echo("
                <div style='text-align: left; margin-left: 15%; font-size: 20px ;'>
                  <form id='fquestion' name='fquestion' method='POST' >
                    <strong>E-mail de la UPV/EHU:</strong>    
                    <input type='text' id='email' name='email' value='".$email."' readonly><br><br>

                    <strong>Contraseña*:</strong>       
                    <input type='password' id='pass1' name='pass1' onchange='verifyPassword()'>
                    <span id='response2'></span><br>
                    <img id='verpas' width='100'/><br><br>

                    <strong>Repetir Contraseña*:</strong> 
                    <input type='password' id='pass2' name='pass2'><br><br>

                    <strong>Codigo*:</strong> 
                    <input type='number' id='cod' name='cod'><br><br>
                    <h3> Le quedan ".(3-$intentos)." intentos</h3><br><br>
                    <input type='submit' value='Cambiar Contraseña' id='regis' disabled='true'>
                  </form>
                </div>

                ");

            }
            else {
              echo("<script>alert('Lo siento, no existen peticiones de cambio de contraseña para esta cuenta'); location.href='Layout.php';</script>");
            }
          }
          
        ?>

      </section>
      <?php include '../html/Footer.html' ?>
      <script src="../js/jquery-3.4.1.min.js"></script>
      <script src="../js/ValidateVipPass.js"></script>
      <script>
        verifyVip();
      </script>
  </body>
</html>