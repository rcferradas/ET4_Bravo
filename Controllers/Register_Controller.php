<?php

session_start();

//session_start();
if (!isset($_POST['login'])) {
    include '../Views/Register_View.php';
    $register = new Register();
} else {

    include '../Models/USUARIOS_Model.php';
    $usuario = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['nombre'], $_REQUEST['apellidos'], $_REQUEST['email']);
    $respuesta = $usuario->Register();

    if ($respuesta == 'true') {
        $respuesta = $usuario->registrar();
        Include '../Views/MESSAGE_View.php';
        new MESSAGE($respuesta, './Login_Controller.php');
    } else {
        include '../Views/MESSAGE_View.php';
        new MESSAGE($respuesta, './Login_Controller.php');
    }
}
?>

