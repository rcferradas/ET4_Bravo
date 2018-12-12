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
        $resultado = $this->mysqli->query($showAll);
        return $resultado;
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent($email) {
        $showCurrent = "SELECT * from contratos WHERE `cod`='$cod'";
        $resultadoCurrent = $this->mysqli->query($showCurrent);
        return $resultadoCurrent;
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