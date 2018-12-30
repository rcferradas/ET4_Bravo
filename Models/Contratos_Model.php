<?php

class Contratos_Model {

    var $mysqli;

//Constructor de la clase
    function __construct() {

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

//Funcion encargada de extraer los datos del SHOWALL
    function showAll() {
        $showAll = "SELECT * from contratos";
        if (!($resultado = $this->mysqli->query($showAll))) {
            echo "NO HAY TUPLAS";
            return true;
        } else {
            return $resultado;
        }
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent() {
        $showCurrent = "SELECT * from contratos WHERE `cod`='cod'";
        if (!($resultado = $this->mysqli->query($showCurrent))) {
            return true;
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        $add = "INSERT INTO `contratos` (`cod`, `centro`, `tipo`, `cifEmpresa`, `documento`, `periodoinicio`, `periodofin`, `importe`) 
        VALUES ('cod', 'centro', 'tipo', 'cifEmpresa', 'documento', 'periodoInicio', 'periodoFin', 'importe')";
        if (!$this->mysqli->query($add)) {
            return 'Error en la inserción';
        }
        return 'Participación añadida con éxito'; //operacion de insertado correcta
    }

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
    function SEARCH() {
        $search = "SELECT * FROM contratos WHERE `cod` LIKE '%" . cod . "%' AND `centro` LIKE '%" . centro . "%' AND `tipo` LIKE '%" . tipo . "%' AND
             `cifEmpresa` LIKE '%" . cifEmpresa . "%' AND `documento` LIKE '%" . documento . "%' AND `periodoInicio` LIKE '%" . periodoInicio . "%' AND
                  `periodoFin` LIKE '%" . periodoFin . "%' AND `importe` LIKE '%" . importe . "%'";
        if (!($resultado = $this->mysqli->query($search))) {
            return true;
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        $delete = "DELETE FROM `contratos` WHERE `cod`='cod'";
        if (!$this->mysqli->query($delete)) {
            return 'Error en la inserción';
        } else {
            return 'Eliminación realizada con éxito';
        }
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $edit = "UPDATE `contratos` SET `centro`='centro',`tipo`='tipo',`cifEmpresa`='cifEmpresa',`documento`='documento',"
                . "`periodoinicio`='periodoInicio',`periodofin`='periodoFin',`importe`='importe' WHERE `cod`='cod'";
    }

}

//fin de clase
?>