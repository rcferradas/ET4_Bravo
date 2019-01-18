<!--17-01-2019/Bravo/Controlador donde se gestiona las acciones de las empresas -->

<?php

session_start();
include '../Functions/Authentication.php';
include '../Views/MESSAGE_View.php';
if (!IsAuthenticated()) {
    new MESSAGE('Debes autentificarte', '../index.php');
} elseif ($_SESSION['rol'] == 'admin')  {//una vez sabemos que está identificado
    require_once '../Models/Empresas_Model.php';
    include '../Views/Empresas_ADD_View.php';
    include '../Views/Empresas_SHOWCURRENT_View.php';
    include '../Views/Empresas_EDIT_View.php';
    include '../Views/Empresas_DELETE_View.php';
    include '../Views/Empresas_SHOWALL_View.php';
    include '../Views/Empresas_SEARCH_View.php';

    function recuperarDataForm() {
        $cif = $_REQUEST['cif'];
        $nombre = $_REQUEST['nombre'];
        $tipo = $_REQUEST['tipo'];
        $telefono = $_REQUEST['telefono'];
        $localizacion = $_REQUEST['localizacion'];

        $action = $_REQUEST['action'];

        $empresas = new Empresas_Model($cif, $nombre, $tipo, $telefono, $localizacion);
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
            if (!isset($_REQUEST['cif'])) { //Si no esta definido el cif vuelve al index.php
                new MESSAGE('No existe la empresa', '../index.php');
            } else {

                $empresas = new Empresas_Model($_REQUEST['cif'], '', '', '', '');    //creamos un objeto del modelo con el cif
                $empresas = $empresas->showCurrent();                                        //y se trae de la BD (a traves del modelo) la tupla asociada a ese cif
                if ($empresas == 'No existe la empresa') {  //Si no se encuentra la tupla
                    new Message($empresas, '../index.php');    //vuelve al al index.php
                } else {
                    if (!$_POST) { //Si se envia por GET se llama a la vista ADD para que se envie por POST
                        $empresas = new Empresas_Model($_REQUEST['cif'], '', '', '', ''); //creamos un objeto del modelo con el cif
                        $valores = $empresas->showCurrent(); //y se trae de la BD (a traves del modelo) la tupla asociada a ese cif
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
                $empresas = new Empresas_Model($_REQUEST['cif'], '', '', '', ''); //creamos un objeto del modelo
                $valores = $empresas->showCurrent(); //se coge de la BD la tupla con dicho cif
                new Empresas_DELETE_View($valores); //se invoca la vista DELETE con los datos a borrar
            } else {
                $empresas = new Empresas_Model($_REQUEST['cif'], '', '', '', '');    //creamos un objeto del modelo con el cif
                $respuesta = $empresas->DELETE();    //se borra la tupla asociada a ese cif
                new MESSAGE($respuesta, '../Controllers/Empresas_Controller.php');
            }
            break;

        case 'SHOWCURRENT':
            $empresas; //Objeto del modelo
            $valores; //Almacena los valores tras almacenarlos
            $empresas = new Empresas_Model($_REQUEST['cif'], '', '', '', ''); //creamos un objeto del modelo con el email
            $valores = $empresas->showCurrent();                                      //y se trae de la BD (a traves del modelo) la tupla asociada a ese email
            new Empresas_SHOWCURRENT_View($valores);     //se invoca la vista SHOWCURRENT con los datos a mostrar
            break;

        case 'SEARCH':
            $empresas; //Objeto del modelo
            $datos; //datos a mostrar extraidos del modelo

            if (!$_POST) {    //Si se envia por GET se llama a la vista EDIT para que se envie por POST
                new Empresas_SEARCH_View();
            } else {
                $empresas = recuperarDataForm();
                $datos = $empresas->SEARCH();
                new Empresas_SHOWALL_View($datos);
            }
            break;

        default:
            $empresas = new Empresas_Model('', '', '', '', '');  //Objeto del modelo
            $recordSet = $empresas->showAll();   //es un array asociativo con los datos, se obtienen los datos de la tabla a traves del modelo (metodo SHOWALL() )
            new Empresas_SHOWALL_View($recordSet);  //se invoca la vista SHOWALL con los datos a mostrar
            break;
    }
}else{
    include_once '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    echo $strings['No tienes permisos para acceder'];
}
?>