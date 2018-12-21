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
        return $this->mysqli->query($showAll);
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent($cod) {
        $showCurrent = "SELECT * from contratos WHERE `cod`='$cod'";
        return $this->mysqli->query($showCurrent);
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD($cod, $centro, $tipo, $cifEmpresa, $documento, $periodoInicio, $periodoFin, $importe) {
        $add = "INSERT INTO `contratos` (`cod`, `centro`, `tipo`, `cifEmpresa`, `documento`, `periodoinicio`, `periodofin`, `importe`) 
        VALUES ('$cod', '$centro', '$tipo', '$cifEmpresa', '$documento', '$periodoInicio', '$periodoFin', '$importe')";
        return $this->mysqli->query($add);
    }

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
    function SEARCH() {
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE($cod) {
        $delete = "DELETE FROM `contratos` WHERE `cod`='$cod'";
        return $this->mysqli->query($delete);
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT($cod, $centro, $tipo, $cifEmpresa, $documento, $periodoInicio, $periodoFin, $importe) {
        $edit = "UPDATE `contratos` SET `centro`='$centro',`tipo`='$tipo',`cifEmpresa`='$cifEmpresa',`documento`='$documento',"
                . "`periodoinicio`='$periodoInicio',`periodofin`='$periodoFin',`importe`='$importe' WHERE `cod`='$cod'";
    }
}

//fin de clase
?>