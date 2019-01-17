<!--17-01-2019/Bravo/Función de cierre de sesión que permite al usuario desconectarse -->

<?php

session_start();
session_destroy();
header('Location:../index.php');
?>
