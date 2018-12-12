<?php

class Contratos_Model {

    var $mysqli;

//Constructor de la clase
    function __construct() {
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

//    var $cod;
//    var $centro;
//    var $tipo;
//    var $empresa;
//    var $documento;
//    var $periodoInicio;
//    var $periodoFin;
//    var $importe;
//    var $estado;
//
////Constructor de la clase
//    function __construct($cod, $centro, $tipo, $empresa, $documento, $periodoInicio, $periodoFin, $importe, $estado) {
//        $this->cod = $cod;
//        $this->centro = $centro;
//        $this->tipo = $tipo;
//        $this->empresa = $empresa;
//        $this->documento = $documento;
//        $this->periodoInicio = $periodoInicio;
//        $this->periodoFin = $periodoFin;
//        $this->importe = $importe;
//        $this->estado = $estado;
//
//        include_once '../Models/Access_DB.php';
//        $this->mysqli = ConnectDB();
//    }

    function showAll() {
        $showAll = "SELECT * from contratos";
        $resultado = $this->mysqli->query($showAll);
        return $resultado;
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        
    }

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
    function __destruct() {
        
    }

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
    function SEARCH() {
        
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        
    }

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
    function RellenaDatos() {
        
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        
    }

}

//fin de clase
?>