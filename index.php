<!--17-01-2019/Bravo/Inicia la sesión y envía al usuario a un controlador o a otro dependiendo de si está identificado -->
<?php

//entrada a la aplicacion
//se va usar la session de la conexion
session_start();

//funcion de autenticacion
include './Functions/Authentication.php';

//si no ha pasado por el login de forma correcta
if (!IsAuthenticated()) {
    header('Location:./Controllers/Login_Controller.php');
}
//si ha pasado por el login de forma correcta 
else {
    header('Location:./Controllers/Contratos_Controller.php');
}
?>
