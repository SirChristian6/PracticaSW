<?php
    session_start();
    if(isset($_GET['email'])&&isset($_GET['avatar'])){
        $_SESSION['email']=$_GET['email'];
        $_SESSION['avatar']=$_GET['avatar'];
        echo("<script>alert('Bienvenido'); location.href='IncreaseGlobalCounter.php';</script>");
    }
?>