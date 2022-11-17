<?php
   session_start();
   unset($_SESSION["id"]);
   unset($_SESSION["username"]);
   
   echo 'Cerrando sesión...';
   header('Location: ./../index.php');
?>