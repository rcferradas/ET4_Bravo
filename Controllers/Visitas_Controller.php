<!--17-01-2019/Bravo/Controlador donde se gestiona las acciones de las visitas -->

<?php

session_start();

//incluir funcion autenticacion
include '../Functions/Authentication.php';
include '../Views/MESSAGE_View.php';
include '../Views/MESSAGEV_View.php';
//si no esta autenticado
if (!IsAuthenticated()) {
    new MESSAGE('Debes autentificarte', '../index.php');
    //header('Location: ../index.php');
}
//esta autenticado
else {

    require_once '../Models/VISITAS_Model.php';
    include '../Views/Visitas_SHOWALL_View.php';
    include '../Views/Visitas_SHOWCURRENT_View.php';
    include '../Views/Visitas_EDIT_View.php';
    include '../Views/Visitas_DELETE_View.php';
    include '../Views/Visitas_ADD_View.php';
    include '../Views/Visitas_INCIDENCIA_View.php';
    include '../Views/Visitas_SEARCH_View.php';

    function recuperarDataForm() {
        $estado = $_REQUEST['estado'];
        $tipo = $_REQUEST['tipo'];
        $codContrato = $_REQUEST['codcontrato'];
        $informe= $_FILES['informe'];
        $fecha = $_REQUEST['fecha'];
        $action = $_REQUEST['action'];    //variable para almacenar la accion a ejecutar

        $visitas = new VISITAS_Model(
                $estado, $tipo, $codContrato, $informe, $fecha);
        return $visitas;
    }
    
      function recuperarDataFormIncidencia() {
        $estado = $_REQUEST['estado'];
        $tipo = $_REQUEST['tipo'];
        $codContrato = $_REQUEST['codcontrato'];
        $informe= $_FILES['informe'];
        $fecha = $_REQUEST['fecha'];
        $codVisitaPadre=$_REQUEST['codvisitapadre'];
        $action = $_REQUEST['action'];    //variable para almacenar la accion a ejecutar

        $visitas = new VISITAS_Model(
                $estado, $tipo, $codContrato, $informe, $fecha,$codVisitaPadre);
        return $visitas;
    }

    if (!isset($_REQUEST['action'])) { //Si la accion no está definida
        $_REQUEST['action'] = 'SHOWALL';     //asignamos la accion SHOWALL
    }

    switch ($_REQUEST['action']) {
        case 'ADD':
            $datos; //Almacena los datos del formulario
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            if (!$_POST) {    //Si se envia por GET se llama a la vista ADD para que se envie por POST, cuestiones de privacidad
                /*$visitas = new VISITAS_Model('', '', '',$_REQUEST['codcontrato'], '', '', '');
                $data = $visitas->datosContrato();*/
                new Visitas_ADD_View($_REQUEST['codcontrato']/*,$data*/);
            } else {
                $datos = recuperarDataForm();
                $respuesta = $datos->ADDNoProgramadas();
                new MESSAGEV($respuesta, '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);
            }
            break;
            
            
             case 'INCIDENCIA':
            $datos; //Almacena los datos del formulario
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            if (!$_POST) {    //Si se envia por GET se llama a la vista ADD para que se envie por POST, cuestiones de privacidad
                new Visitas_INCIDENCIA_View($_REQUEST['codcontrato'],$_REQUEST['codvisita']);
            } else {
                $datos = recuperarDataFormIncidencia();
                $respuesta = $datos->ADDNoProgramadas();
                new MESSAGEV($respuesta, '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);
            }
            break;

        case 'SEARCH':
            $visitas; //Objeto del modelo
            $datosContrato; //datos a mostrar extraidos del modelo

            if (!$_POST) {    //Si se envia por GET se llama a la vista EDIT para que se envie por POST
                $vis=new VISITAS_Model($_REQUEST['codcontrato']);
                $datos=$vis->datosContrato();
                new Visitas_SEARCH_View($datos,$_REQUEST['codcontrato']);
            } else {
                $visitas = new Visitas_Model('',$_REQUEST['estado'],$_REQUEST['tipo'],$_REQUEST['codcontrato'],'','',$_REQUEST['padre']);  //Objeto del modelo
                $recordSet = $visitas->SEARCH($_REQUEST['fechainicio'],$_REQUEST['fechafin']);   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
                new Visitas_SHOWALL_View($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
          
            }
            break;

        case 'EDIT':
            $visitas; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos
            if (!isset($_REQUEST['codvisita'])) { //Si no esta definido el email (o alguien modifica el enlace) vuelve al index.php
                new MESSAGEV('No existe la visita', '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);
            } else {
                $visitas = new VISITAS_Model($_REQUEST['codvisita'],'','');    //creamos un objeto del modelo con el email
                $valores = $visitas->SHOWCURRENT();                                       //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                if ($valores == 'No existe dicha tupla') {  //Si no se encuentra la tupla
                    new MESSAGEV($valores, '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);    //vuelve al al index.php
                } else {
                     $informe = $valores['informe'];
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST                                                          
                        new Visitas_EDIT_View($valores);
                    } else {
                        if ($_FILES['informe']['size'] == 0) { //Si el resguardo que viene del formulario EDIT viene sin definir o vacío, nso quedamos con el resguardo que ya teniamos
                            $visitas = new VISITAS_Model($_REQUEST['codvisita'],$_REQUEST['estado'], $_REQUEST['tipo'], $_REQUEST['codcontrato'],$informe, $_REQUEST['fecha'],'');
                        } else{
                        $visitas = new VISITAS_Model($_REQUEST['codvisita'],$_REQUEST['estado'], $_REQUEST['tipo'], $_REQUEST['codcontrato'],$_FILES['informe'], $_REQUEST['fecha'],'');
                        }
                        $respuesta = $visitas->EDIT();
                        new MESSAGEV($respuesta, '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);
                    }
                }
            }
            break;

        case 'DELETE':
            $visitas; //Objeto del modelo
            $respuesta; //Almacena la respuesta que se mostrará via MESSAGE
            $valores; //Almacena los valores tras almacenarlos

            if (!$_POST) {
                $visitas = new VISITAS_Model($_REQUEST['codvisita'],$_REQUEST['codcontrato'],'');     //creamos un objeto del modelo con el email
                $valores = $visitas->showCurrent();                                          //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
                new Visitas_DELETE_View($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $visitas = new VISITAS_Model($_REQUEST['codvisita'],$_REQUEST['codcontrato'],'',$_REQUEST['informe']);    //creamos un objeto del modelo con el email
                $respuesta = $visitas->DELETE();                                              //y se borra la tupla asociada a ese email invocando el metodo DELETE() del modelo
                new MESSAGEV($respuesta, '../Controllers/Visitas_Controller.php',$_REQUEST['codcontrato']);
            }
            break;

        case 'SHOWCURRENT':
            $visitas; //Objeto del modelo
            $valores; //Almacena los valores tras almacenarlos
            $visitas = new VISITAS_Model($_REQUEST['codvisita'],$_REQUEST['codcontrato'],''); //creamos un objeto del modelo con el email
            $valores = $visitas->showCurrent();                                      //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
            new Visitas_SHOWCURRENT_View($valores);     //se invoca la vista SHOWCURRENT con los datos a mostrar
            break;
        
        case 'SHOWALL':
            $visitas = new Visitas_Model($_REQUEST['codcontrato']);  //Objeto del modelo
            $datosContrato=$visitas->datosContrato();
            $recordSet = $visitas->showVisitas($_REQUEST['codcontrato'],$datosContrato[2]);   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Visitas_SHOWALL_View($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
            break;

           }
}
?>