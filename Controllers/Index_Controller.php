<?php

//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()) {
    header('Location: ../index.php');
}
//esta autenticado
else {
    include '../Views/users_index_View.php';
    new Index();
}
?>