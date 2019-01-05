<?php

session_start();
include '../Functions/Authentication.php';
include '../Views/MESSAGE_View.php';
if (!IsAuthenticated()) {
    new MESSAGE('Debes autentificarte', '../index.php');
}
else {//una vez sabemos que está identificado

    require_once '../Models/Empresas_Model.php';
    include '../Views/Empresas_ADD_View.php';
    include '../Views/Empresas_EDIT_View.php';
    include '../Views/Empresas_DELETE_View.php';
    include '../Views/Empresas_SHOWALL_View.php';
    

    function recuperarDataForm() {
        $CIF = $_REQUEST['CIF'];
        $nombre = $_REQUEST['nombre'];
        $tipo = $_REQUEST['tipo'];
        $telefono = $_REQUEST['telefono'];
        $localizacion = $_REQUEST['localizacion'];
        
        $action = $_REQUEST['action'];

        $empresas = new Empresas_Model($CIF, $nombre, $tipo, $telefono, $localizacion);
        return $empresas;
    }

    if (!isset($_REQUEST['action'])) { //Si la accion no está definida
        $_REQUEST['action'] = '';     //asignamos la accion vacía
    }

    switch ($_REQUEST['action']) {//según la acción seleccionada entramos en un caso
        case 'ADD'://caso para añadir una nueva empresa
            $empresas;
            $respuesta;
            if (!$_POST) {
                new Empresas_ADD_View();
            } else {
                $empresas = recuperarDataForm();
                $respuesta = $empresas->ADD();
                new MESSAGE($respuesta, '../Controllers/Empresas_Controller.php');
            }
            break;
            
        case 'EDIT'://caso para editar empresa
            $empresas; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos
            if (!isset($_REQUEST['CIF'])) { //Si no esta definido el CIF vuelve al index.php
                new MESSAGE('No existe la empresa', '../index.php');
            } else {

                $empresas = new Empresas_Model($_REQUEST['CIF'], '', '', '', '');    //creamos un objeto del modelo con el CIF
                $empresas = $empresas->showCurrent();                                        //y se trae de la BD (a traves del modelo) la tupla asociada a ese CIF
                if ($empresas == 'No existe la empresa') {  //Si no se encuentra la tupla
                    new Message($empresas, '../index.php');    //vuelve al al index.php
                } else {
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST
                        $empresas = new Empresas_Model($_REQUEST['CIF'], '', '', '', ''); //creamos un objeto del modelo con el CIF
                        $valores = $empresas->showCurrent();//y se trae de la BD (a traves del modelo) la tupla asociada a ese CIF
                        new Empresas_EDIT_View($valores);
                    } else {
                        $empresas = recuperarDataForm();  //coge los datos introducidos en el formulario
                        $respuesta = $empresas->EDIT();
                        new MESSAGE($respuesta, '../Controllers/Empresas_Controller.php');
                    }
                }
            }
            break;

        case 'DELETE':
            $empresas;
            $respuesta;
            $valores;

            if (!$_POST) {
                $empresas = new Empresas_Model($_REQUEST['CIF'], '', '', '', ''); //creamos un objeto del modelo
                $valores = $empresas->RellenaDatos(); //se coge de la BD la tupla con dicho CIF
                new Empresas_DELETE_View($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $empresas = new Empresas_Model($_REQUEST['CIF'], '', '', '', '');    //creamos un objeto del modelo con el CIF
                $respuesta = $empresas->DELETE();    //se borra la tupla asociada a ese CIF
                new MESSAGE($respuesta, '../Controllers/Empresas_Controller.php');
            }
            break;
            
        default:
            $empresas = new Empresas_Model('', '', '', '', '');  //Objeto del modelo
            $datosAMostrar = array('CIF', 'tipo', 'telefono');    //array de atributos a mostrar
            $recordSet = $empresas->showAll();   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Empresas_SHOWALL_View($recordSet, $datosAMostrar);  //se invoca la vista SHOWALL con los datos a mostrar
            break;
    }
}
?>