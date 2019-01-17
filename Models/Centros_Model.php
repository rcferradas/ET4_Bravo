<?php

class Centros_Model {

    var $nombre;
    var $lugar;
    var $usuarioAsignado;
    var $mysqli;

    function __construct($nombre, $lugar, $usuarioAsignado) {
        $this->nombre = $nombre;
        $this->lugar = $lugar;
        $this->usuarioAsignado = $usuarioAsignado;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    //Funcion encargada de extraer los datos del SHOWALL
    function showAll() {
        $sql = "SELECT * FROM centros";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent() {
        $showCurrent = "SELECT * from centros WHERE `nombre`='$this->nombre'";
        $resultado = $this->mysqli->query($showCurrent);
        if ($resultado->num_rows == 1) { //Si existe dicha tupla
            $tupla = $resultado->fetch_assoc(); //Creamos un array asociativo que almacena los valores de la tupla
            $this->nombre = $tupla['nombre'];
            $this->lugar = $tupla['lugar'];
            $this->usuarioAsignado = $tupla['usuarioAsignado'];
            return $tupla; //devolvemos el array asociativo
        } else {
            return 'No existe dicha tupla';
        }
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        $sql = "INSERT INTO centros VALUES('$this->nombre','$this->lugar','$this->usuarioAsignado')";
        if (!$this->mysqli->query($sql)) {
            return "Error en la inserción";
        } else {
            return "Insertado con éxito";
        }
    }

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
    function __destruct() {
        
    }

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
    function SEARCH() {
        $sql = "SELECT * FROM centros WHERE `lugar` LIKE '%$this->lugar%' AND `nombre` LIKE '%$this->nombre%' AND `usuarioAsignado` LIKE '%$this->usuarioAsignado%'";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        $sql = "SELECT * FROM centros WHERE (`nombre` = '$this->nombre')";
        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 1) {
            $sql = "DELETE FROM centros WHERE (`nombre` = '$this->nombre')";
            $this->mysqli->query($sql);
            return 'Eliminado correctamente';
        } else
            return 'No existe en la base de datos';
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $sql = "SELECT * FROM centros WHERE (`nombre` = '$this->nombre')";
        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 1) {
            $sql = "UPDATE centros SET `lugar` = '$this->lugar', `usuarioAsignado` = '$this->usuarioAsignado' WHERE `nombre` = '$this->nombre'";
            if (!$this->mysqli->query($sql)) {
                return 'Error al editar';
            } else {
                return 'Modificación completada';
            }
        } else
            return 'No existe la tupla';
    }
    
    function getUsuarios(){
        $sql = "SELECT `login` FROM USUARIOS";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    } 
}

//fin de clase
?>
