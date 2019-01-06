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
else {

    require_once '../Models/Contratos_Model.php';
    include '../Views/Contrato_SHOWALL_View.php';
    include '../Views/Contrato_SHOWCURRENT_View.php';
    include '../Views/Contrato_EDIT_View.php';
    include '../Views/Contrato_DELETE_View.php';
    include '../Views/Contrato_ADD_View.php';
    include '../Views/Contrato_SEARCH_View.php';

    function recuperarDataForm() {
        $cod = $_REQUEST['cod'];
        $centro = $_REQUEST['centro'];
        $tipo = $_REQUEST['tipo'];
        $estado = $_REQUEST['estado'];
        $cifEmpresa = $_REQUEST['cifEmpresa'];
        $documento = $_FILES['documento'];
        $periodoinicio = $_REQUEST['periodoinicio'];
        $periodofin = $_REQUEST['periodofin'];
        $importe = $_REQUEST['importe'];

        $action = $_REQUEST['action'];    //variable para almacenar la accion a ejecutar

        $contratos = new Contratos_Model(
                $cod, $centro, $tipo, $estado, $cifEmpresa, $documento, $periodoinicio, $periodofin, $importe
        );
        return $contratos;
    }

    if (!isset($_REQUEST['action'])) { //Si la accion no está definida
        $_REQUEST['action'] = '';     //asignamos la accion vacía
    }

    switch ($_REQUEST['action']) {
        case 'ADD':
            $datos; //Almacena los datos del formulario
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            if (!$_POST) {    //Si se envia por GET se llama a la vista ADD para que se envie por POST, cuestiones de privacidad
                new Contratos_ADD();
            } else {
                $datos = recuperarDataForm();
                $respuesta = $datos->ADD();
                new MESSAGE($respuesta, '../Controllers/Contratos_Controller.php');
            }
            break;

        case 'SEARCH':
            $contratos; //Objeto del modelo
            $datos; //datos a mostrar extraidos del modelo

            if (!$_POST) {    //Si se envia por GET se llama a la vista EDIT para que se envie por POST
                new Contrato_SEARCH();
            } else {
                $contratos = new Contratos_Model($_REQUEST['cod'], $_REQUEST['centro'], $_REQUEST['tipo'], $_REQUEST['estado'], '', $_REQUEST['cifEmpresa'], $_REQUEST['periodoinicio'], $_REQUEST['periodofin'], $_REQUEST['importe']);
                $datos = $contratos->SEARCH();
                new Contrato_SHOWALL($datos);
            }
            break;

        case 'EDIT':
            $contratos; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos
            if (!isset($_REQUEST['cod'])) { //Si no esta definido el email (o alguien modifica el enlace) vuelve al index.php
                new MESSAGE('No existe el contrato', '../index.php');
            } else {
                $contratos = new Contratos_Model($_REQUEST['cod'], '','', '', '', '', '', '', '');    //creamos un objeto del modelo con el email
                $contratos = $contratos->showCurrent();                                        //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                if ($contratos == 'No existe el contrato') {  //Si no se encuentra la tupla
                    new Message($contratos, '../index.php');    //vuelve al al index.php
                } else {
                    $documento = $contratos['documento'];
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST
                        $contratos = new Contratos_Model($_REQUEST['cod'], '','', '', '', '', '', '', ''); //creamos un objeto del modelo con el codigo de contrato
                        $valores = $contratos->showCurrent();                                       //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                        new Contratos_EDIT($valores);
                    } else {
                        if (!isset($_FILES['documento']['name']) || $_FILES['documento']['name'] == '') { //Si el resguardo que viene del formulario EDIT viene sin definir o vacío, nso quedamos con el resguardo que ya teniamos
                            $contratos = new Contratos_Model($_REQUEST['cod'], $_REQUEST['centro'], $_REQUEST['tipo'], $_REQUEST['estado'], $_REQUEST['cifEmpresa'], $documento, $_REQUEST['periodoinicio'], $_REQUEST['periodofin'], $_REQUEST['importe']);
                        } else {
                            $contratos = recuperarDataForm();  //que utilizara el resguardo que introduzcamos en el formulario edit
                        }
                        $respuesta = $contratos->EDIT();
                        new MESSAGE($respuesta, '../Controllers/Contratos_Controller.php');
                    }
                }
            }
            break;

        case 'DELETE':
            $contratos; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos

            if (!$_POST) {
                $contratos = new Contratos_Model($_REQUEST['cod'], '', '','', '', '', '', '', '');     //creamos un objeto del modelo con el email
                $valores = $contratos->showCurrent();                                          //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                new Contrato_DELETE($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $contratos = new Contratos_Model($_REQUEST['cod'], '', '', '', '', '', '', '');    //creamos un objeto del modelo con el email
                $respuesta = $contratos->DELETE();                                              //y se borra la tupla asociada a ese email invocando el metodo DELETE() del modelo
                new MESSAGE($respuesta, '../Controllers/Contratos_Controller.php');
            }
            break;

        case 'SHOWCURRENT':
            $contratos; //Objeto del modelo
            $valores; //Almacena los valores tras almacenarlos
            $contratos = new Contratos_Model($_REQUEST['cod'], '', '','', '', '', '', '', ''); //creamos un objeto del modelo con el email
            $valores = $contratos->showCurrent();                                      //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
            new Contrato_SHOWCURRENT($valores);     //se invoca la vista SHOWCURRENT con los datos a mostrar
            break;

        default:
            $contratos = new Contratos_Model('', '', '', '', '', '', '', '', '');  //Objeto del modelo
            $recordSet = $contratos->showAll();   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Contrato_SHOWALL($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
            break;
    }
}
?>