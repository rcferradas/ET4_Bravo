<!--17-01-2019/Bravo/Función de cambio de idioma -->

<?php

session_start();
$idioma = $_POST['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>