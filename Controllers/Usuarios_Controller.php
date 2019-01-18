<!--17-01-2019/Bravo/Controlador donde se gestiona las acciones de los usuarios -->

<?php

session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
include '../Views/MESSAGE_View.php';
//si no esta autenticado
if (!IsAuthenticated()) {
    new MESSAGE('Debes autentificarte', '../index.php');
    //header('Location: ../index.php');
}
//esta autenticado
elseif ($_SESSION['rol'] == 'admin') {

    require_once '../Models/USUARIOS_Model.php';
    include '../Views/Usuarios_SHOWALL_View.php';
    include '../Views/Usuarios_ADD_View.php';
    include '../Views/Usuarios_SHOWCURRENT_View.php';
    include '../Views/Usuarios_EDIT_View.php';
    include '../Views/Usuarios_DELETE_View.php';
    include '../Views/Usuarios_SEARCH_View.php';

    function recuperarDataForm() {
        $login = $_REQUEST['login'];
        if (isset($_REQUEST['password'])) {
            $password = $_REQUEST['password'];
        } else {
            $password = "";
        }
        $dni = $_REQUEST['DNI'];
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $telefono = $_REQUEST['telefono'];
        $email = $_REQUEST['email'];
        $rol = $_REQUEST['rol'];

        $action = $_REQUEST['action'];    //variable para almacenar la accion a ejecutar

        $usuarios = new Usuarios_Model(
                $login, $password, $dni, $nombre, $apellidos, $telefono, $email, $rol
        );
        return $usuarios;
    }

    if (!isset($_REQUEST['action'])) { //Si la accion no está definida
        $_REQUEST['action'] = '';     //asignamos la accion vacía
    }

    switch ($_REQUEST['action']) {
        case 'ADD':
            $datos; //Almacena los datos del formulario
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            if (!$_POST) {    //Si se envia por GET se llama a la vista ADD para que se envie por POST, cuestiones de privacidad
                new Usuarios_ADD_View();
            } else {
                $datos = recuperarDataForm();
                $respuesta = $datos->registrar();
                new MESSAGE($respuesta, '../Controllers/Usuarios_Controller.php');
            }
            break;

        case 'SEARCH':
            $usuarios; //Objeto del modelo
            $datos; //datos a mostrar extraidos del modelo

            if (!$_POST) {    //Si se envia por GET se llama a la vista EDIT para que se envie por POST
                new Usuarios_SEARCH_View();
            } else {
                $usuarios = recuperarDataForm();
                $datos = $usuarios->SEARCH();
                new Usuarios_SHOWALL_View($datos);
            }
            break;

        case 'EDIT':
            $usuarios; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos
            if (!isset($_REQUEST['login'])) { //Si no esta definido el email (o alguien modifica el enlace) vuelve al index.php
                new MESSAGE('No existe el contrato', '../index.php');
            } else {
                $usuarios = new Usuarios_Model($_REQUEST['login'], '', '', '', '', '', '', '');    //creamos un objeto del modelo con el email
                $usuarios = $usuarios->showCurrent();                                        //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                if ($usuarios == 'No existe el usuario') {  //Si no se encuentra la tupla
                    new Message($usuarios, '../index.php');    //vuelve al al index.php
                } else {
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST
                        $usuarios = new Usuarios_Model($_REQUEST['login'], '', '', '', '', '', '', ''); //creamos un objeto del modelo con el loginigo de contrato
                        $valores = $usuarios->showCurrent();                                       //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                        new Usuarios_EDIT_View($valores);
                    } else {
                        $usuarios = recuperarDataForm();  //que utilizara el resguardo que introduzcamos en el formulario edit
                        $respuesta = $usuarios->EDIT();
                        new MESSAGE($respuesta, '../Controllers/Usuarios_Controller.php');
                    }
                }
            }
            break;

        case 'DELETE':
            $usuarios; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos

            if (!$_POST) {
                $usuarios = new Usuarios_Model($_REQUEST['login'], '', '', '', '', '', '', '');     //creamos un objeto del modelo con el email
                $valores = $usuarios->showCurrent();                                          //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                new Usuarios_DELETE_View($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $usuarios = new Usuarios_Model($_REQUEST['login'], '', '', '', '', '', '', '');    //creamos un objeto del modelo con el email
                $respuesta = $usuarios->DELETE();                                              //y se borra la tupla asociada a ese email invocando el metodo DELETE() del modelo
                new MESSAGE($respuesta, '../Controllers/Usuarios_Controller.php');
            }
            break;

        case 'SHOWCURRENT':
            $usuarios; //Objeto del modelo
            $valores; //Almacena los valores tras almacenarlos
            $usuarios = new Usuarios_Model($_REQUEST['login'], '', '', '', '', '', '', ''); //creamos un objeto del modelo con el email
            $valores = $usuarios->showCurrent();                                      //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
            new Usuarios_SHOWCURRENT_View($valores);     //se invoca la vista SHOWCURRENT con los datos a mostrar
            break;

        default:
            $usuarios = new Usuarios_Model('', '', '', '', '', '', '', '');  //Objeto del modelo
            $recordSet = $usuarios->showAll();   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Usuarios_SHOWALL_View($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
            break;
    }
} else {
    include_once '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    echo $strings['No tienes permisos para acceder'];
}
?>