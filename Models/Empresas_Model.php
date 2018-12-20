<?php

class Empresas_Model {
    
    var $tipo;
    var $nombre;
    var $telefono;
    var $localizacion;
    var $CIF;
    var $mysqli;
    
    function __construct($tipo,$nombre,$telefono,$localizacion,$CIF){
	$this->tipo = $tipo;
	$this->nombre = $nombre;
	$this->telefono = $telefono;
	$this->localizacion = $localizacion;
	$this->CIF = $CIF;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}
    //Funcion encargada de extraer los datos del SHOWALL
    function showAll() {
        $sql;
        $resultado;
        $sql= "SELECT 'tipo','CIF','telefono' FROM empresas";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//Funcion encargada de extraer los datos del SHOWCURRENT
    function showCurrent() {
        $sql;
        $resultado;
        $sql="SELECT * FROM empresas WHERE 'CIF' = '".$this->$CIF."'";
        $resultado = $this->mysqli->query($sql);
        return resultado;
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        $sql = "INSERT INTO empresas VALUES('$this->tipo','$this->nombre',$this->telefono,'$this->localizacion',$this->CIF)";
        if(!$this->mysqli->query($sql)){
            return "Error en la inserción";
        }else{
            return "Insertado Exitoso";
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
                    WHERE 'tipo' LIKE '%$this->tipo%' AND 'nombre' LIKE '%$this->nombre%' AND 'telefono' LIKE '%$this->telefono%'
                    AND 'localizacion' LIKE '%$this->localizacion%' AND 'CIF' LIKE '%$this->CIF%'";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        $sql;
        $resultado;
        $sql = "SELECT * FROM empresas WHERE ('CIF' = '".$this->CIF."')";
        $resultado = $this->mysqli->query($sql); 
        if ($resultado->num_rows == 1){
            $sql = "DELETE FROM empresas WHERE ('CIF' = '".$this->CIF."')";
            $this->mysqli->query($sql);
            return 'Eliminado correctamente'; 
        } 
        else return 'No existe en la base de datos';        
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
    $sql;
    $resultado;
    $sql="SELECT * FROM empresas WHERE ('CIF' = '".$this->CIF."')";       
    $resultado = $this->mysqli->query($sql);
    if($resultado->num_rows == 1){
        $sql="UPDATE empresas
                     SET 'tipo' = '$this->tipo', 'nombre' = '$this->nombre', 'telefono' = $this->telefono ,
                     'localizacion' = '$this->localizacion' WHERE 'CIF' = '$this->CIF'";
        if(!$this->mysqli->query($sql)){
            return 'Error al editar';
        }else{
            return 'Modificación completada';
        }
    }else 
        return 'No existe la tupla';        
    }

}

//fin de clase
?>
