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
    require_once '../Models/Centros_Model.php';
    include '../Views/Centros_SHOWALL_View.php';
    include '../Views/Centros_ADD_View.php';
//    include '../Views/Centro_SHOWCURRENT_View.php';
    include '../Views/Centros_EDIT_View.php';
    include '../Views/Centros_DELETE_View.php';
    include '../Views/Centros_SEARCH_View.php';

    function recuperarDataForm() {
        $nombre = $_REQUEST['nombre'];
        $lugar = $_REQUEST['lugar'];
        $nombre = $_REQUEST['nombre'];
        $usuarioAsignado = $_REQUEST['usuarioAsignado'];

        $action = $_REQUEST['action'];    //variable para almacenar la accion a ejecutar

        $centros = new Centros_Model($nombre, $lugar, $usuarioAsignado);
        return $centros;
    }

    if (!isset($_REQUEST['action'])) { //Si la accion no está definida
        $_REQUEST['action'] = '';     //asignamos la accion vacía
    }

    switch ($_REQUEST['action']) {
        case 'ADD':
            $datos; //Almacena los datos del formulario
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            if (!$_POST) {    //Si se envia por GET se llama a la vista ADD para que se envie por POST, cuestiones de privacidad
                $usuarios = new Centros_Model('', '', '');
                $data = $usuarios->getUsuarios();                
                new Centros_ADD_View($data);
            } else {
                $datos = recuperarDataForm();
                $respuesta = $datos->ADD();
                new MESSAGE($respuesta, '../Controllers/Centros_Controller.php');
            }
            break;

        case 'SEARCH':
            $centros; //Objeto del modelo
            $datos; //datos a mostrar extraidos del modelo

            if (!$_POST) {    //Si se envia por GET se llama a la vista EDIT para que se envie por POST
                new Centros_SEARCH_View();
            } else {
                $centros = recuperarDataForm();
                $datos = $centros->SEARCH();
                new Centros_SHOWALL_View($datos);
            }
            break;

        case 'EDIT':
            $centros; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos
            if (!isset($_REQUEST['nombre'])) { //Si no esta definido el email (o alguien modifica el enlace) vuelve al index.php
                new MESSAGE('No existe el centro', '../index.php');
            } else {
                $centros = new Centros_Model($_REQUEST['nombre'], '', '');    //creamos un objeto del modelo con el email
                $centros = $centros->showCurrent();                                        //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                if ($centros == 'No existe el usuario') {  //Si no se encuentra la tupla
                    new Message($centros, '../index.php');    //vuelve al al index.php
                } else {
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST
                        $centros = new Centros_Model($_REQUEST['nombre'], '', ''); //creamos un objeto del modelo con el nombreigo de contrato
                        $valores = $centros->showCurrent();                                       //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                        $usuarios = new Centros_Model('', '', '');
                        $data = $usuarios->getUsuarios();                         
                        new Centros_EDIT_View($valores,$data);
                    } else {
                        $centros = recuperarDataForm();  //que utilizara el resguardo que introduzcamos en el formulario edit
                        $respuesta = $centros->EDIT();
                        new MESSAGE($respuesta, '../Controllers/Centros_Controller.php');
                    }
                }
            }
            break;

        case 'DELETE':
            $centros; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos

            if (!$_POST) {
                $centros = new Centros_Model($_REQUEST['nombre'], '', '');     //creamos un objeto del modelo con el email
                $valores = $centros->showCurrent();                                          //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                new Centros_DELETE_View($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $centros = new Centros_Model($_REQUEST['nombre'], '', '');    //creamos un objeto del modelo con el email
                $respuesta = $centros->DELETE();                                              //y se borra la tupla asociada a ese email invocando el metodo DELETE() del modelo
                new MESSAGE($respuesta, '../Controllers/Centros_Controller.php');
            }
            break;

//        case 'SHOWCURRENT':
//            $centros; //Objeto del modelo
//            $valores; //Almacena los valores tras almacenarlos
//            $centros = new Centros_Model($_REQUEST['nombre'], '', ''); //creamos un objeto del modelo con el email
//            $valores = $centros->showCurrent();                                      //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
//            new Centro_SHOWCURRENT($valores);     //se invoca la vista SHOWCURRENT con los datos a mostrar
//            break;

        default:
            $centros = new Centros_Model('', '', '');  //Objeto del modelo
            $recordSet = $centros->showAll();   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Centros_SHOWALL_View($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
            break;
    }
}else{
    include_once '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    echo $strings['No tienes permisos para acceder'];
}
?>