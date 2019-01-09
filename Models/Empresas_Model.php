<?php

class Empresas_Model {

    var $cif;
    var $nombre;
    var $tipo;
    var $telefono;
    var $localizacion;
    var $mysqli;

    function __construct($cif, $nombre, $tipo, $telefono, $localizacion) {
        $this->cif = $cif;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->telefono = $telefono;
        $this->localizacion = $localizacion;


        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    //Funcion encargada de extraer los datos del SHOWALL
    function showAll() {
        $sql = "SELECT * FROM empresas";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent() {
        $sql;
        $resultado;
        $sql = "SELECT * FROM empresas WHERE 'cif' = '" . $this->$cif . "'";
        $resultado = $this->mysqli->query($sql);
        return resultado;
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        $sql = "INSERT INTO empresas VALUES('$this->cif','$this->nombre','$this->tipo','$this->telefono','$this->localizacion')";
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
        $sql;
        $resultado;
        $sql = "SELECT * FROM empresas
                    WHERE 'cif' LIKE '%$this->cif%' AND 'nombre' LIKE '%$this->nombre%' AND 'tipo' LIKE '%$this->tipo%'
                    AND 'telefono' LIKE '%$this->telefono%' AND 'localizacion' LIKE '%$this->localizacion%'";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        $sql;
        $resultado;
        $sql = "SELECT * FROM empresas WHERE ('cif' = '" . $this->cif . "')";
        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 1) {
            $sql = "DELETE FROM empresas WHERE ('cif' = '" . $this->cif . "')";
            $this->mysqli->query($sql);
            return 'Eliminado correctamente';
        } else
            return 'No existe en la base de datos';
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $sql;
        $resultado;
        $sql = "SELECT * FROM empresas WHERE ('cif' = '" . $this->cif . "')";
        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 1) {
            $sql = "UPDATE empresas
                     SET 'nombre' = '$this->nombre', 'tipo' = '$this->tipo', 'telefono' = $this->telefono ,
                     'localizacion' = '$this->localizacion' WHERE 'cif' = '$this->cif'";
            if (!$this->mysqli->query($sql)) {
                return 'Error al editar';
            } else {
                return 'Modificación completada';
            }
        } else
            return 'No existe la tupla';
    }

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
    function RellenaDatos() {
        $sql;
        $resultado;
        $result;
        $sql = "SELECT * FROM empresas WHERE ('cif' = '" . $this->cif . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'No existe en la base de datos';
        } else {
            $result = $resultado->fetch_array();
            $this->cif = $result[0];
            $this->nombre = $result[1];
            $this->tipo = $result[2];
            $this->telefono = $result[3];
            $this->localizacion = $result[4];

            return $result;
        }
    }

// fin metodo RellenaDatos
}

//fin de clase
?>
