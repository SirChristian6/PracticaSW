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
          if($encontrado!=0){
            echo("<script>location.href='Layout.php';</script>");
          }
        ?>
        <h2>Cambiar Contraseña</h2><br>
        <div style="text-align: left; margin-left: 15%; font-size: 20px ;">

          <form id="fquestion" name="fquestion" method="POST" >
                <strong>E-mail de la UPV/EHU*:</strong>    <input type="text" id="email"    name="email"><br><br>
                <input type="submit" value="Cambiar Contraseña" id="changepass">
          </form>
        </div>

        <?php
          if(isset($_POST['email'])){
            $email=$_POST['email'];
            $existe=0;
            include "DbConfig.php";
            $mysqli=mysqli_connect($server,$user,$pass,$basededatos); //Abrir conexion con la BD
            if($mysqli){
              $sql = mysqli_query($mysqli, "SELECT email,estado FROM usuarios" ); //Sentencia SQL para conseguir los emails
              if ($sql){
                while( $usuarios=mysqli_fetch_array($sql) ){  //comparar email de la URL con los existentes en la BD
                  if( strcmp($usuarios['email'], $email)==0){
                    if(strcmp($usuarios['estado'], 'activado')==0){
                      $existe=1;
                      $codigo=rand(10000,99999);
                      mysqli_query($mysqli, "DELETE FROM cambiarpass WHERE email='$email'" );
                      mysqli_query($mysqli, "INSERT INTO cambiarpass VALUES ('$email','$codigo',0)" );
                      $asunto="Cambiar Contraseña";
                      $mensaje="<html>
                                  <head>
                                    <title> Cambio de Contraseña</title>
                                  </head>
                                  <body>
                                    <h3> Entre en el link enviado e introduzca el código facilitado a continuación</h3>
                                    <h3>".$codigo." </h3>
                                    <h2> <a href='https://sistemaswebchernandez.000webhostapp.com/PracticaSW/php/CambiarPass2.php?email=".$email."'>Cambiar Contraseña</a></h2>
                                  </body>
                                </html>";
                      $headers="MIME-Version: 1.0"."\r\n";
                      $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
                      mail($email,$asunto,$mensaje,$headers);
                    }
                    else{
                      $existe=2;
                    }
                    break;
                  }
                }
                $sql->close();
              }
              mysqli_close($mysqli);
            }
            if($existe==1){
              echo("<br><h3> Se le ha enviado un email al correo electronico, en caso de no aparecer compruebe la bandeja de spam o vuelva a mandar una solicitud más tarde</h3>");
            }
            else if($existe==2){
              echo("<br><h3> Lo siento, usted no tiene permiso para gestionar esta cuenta</h3>");
            }
            else{
              echo("<br><h3> Lo siento, el correo introducido no existe o han habido problemas, en cuyo caso vuelva a intentarlo más tarde</h3>");
            }
          }
          
        ?>

      </section>
      <?php include '../html/Footer.html' ?>
      <script src="../js/jquery-3.4.1.min.js"></script>
  </body>
</html>