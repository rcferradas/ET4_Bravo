<!--17-01-2019/Bravo/Modelo de contratos que empleamos para acceder a la base de datos y coger los datos que nos interesan-->

<?php
$codigoDelContrato; //Variable global para recuperar el codigo del ultimo contrato creado

class Contratos_Model {

    var $cod;
    var $centro;
    var $tipo;
    var $estado;
    var $cifEmpresa;
    var $documento;
    var $periodoInicio;
    var $periodoFin;
    var $frecuencia;
    var $importe;
    var $mysqli;

//Constructor de la clase
    function __construct($cod, $centro, $tipo, $estado, $cifEmpresa, $documento, $periodoInicio, $periodoFin,$frecuencia, $importe) {
        $this->cod = $cod;
        $this->centro = $centro;
        $this->tipo = $tipo;
        $this->estado = $estado;
        $this->cifEmpresa = $cifEmpresa;
        $this->documento = $documento;
        $this->periodoInicio = $periodoInicio;
        $this->periodoFin = $periodoFin;
        $this->frecuencia = $frecuencia;
        $this->importe = $importe;

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
        $showCurrent = "SELECT * from contratos WHERE `cod`='$this->cod'";
        $resultado = $this->mysqli->query($showCurrent);
        if ($resultado->num_rows == 1) { //Si existe dicha tupla
            $tupla = $resultado->fetch_assoc(); //Creamos un array asociativo que almacena los valores de la tupla
            $this->centro = $tupla['centro'];
            $this->tipo = $tupla['tipo'];
            $this->estado = $tupla['estado'];
            $this->cifEmpresa = $tupla['cifEmpresa'];
            $this->periodoInicio = $tupla['periodoinicio'];
            $this->periodoFin = $tupla['periodofin'];
            $this->frecuencia= $tupla['frecuenciaVisitas'];
            $this->importe = $tupla['importe'];
            return $tupla; //devolvemos el array asociativo
        } else {
            return 'No existe el contrato';
        }
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        global $codigoDelContrato;
        $codigo = "SELECT MAX(`cod`) as codigo FROM contratos";
        $modeloCodigo = $this->mysqli->query($codigo);
        $tupla = $modeloCodigo->fetch_assoc();
        $numero = $tupla['codigo'];
        $codigoDelContrato = intval($numero) + 1;
        $this->cod = $codigoDelContrato;
        $rutaDocumento = $this->funcionRutaDocumento();
        $add = "INSERT INTO contratos (`cod`, `centro`, `tipo`, `estado`, `cifEmpresa`, `documento`, `periodoinicio`, `periodofin`,`frecuenciaVisitas`, `importe`) 
        VALUES ($this->cod, '$this->centro', '$this->tipo', '$this->estado', '$this->cifEmpresa', '$rutaDocumento', '$this->periodoInicio', '$this->periodoFin','$this->frecuencia', '$this->importe')";
        if (!($resultado = $this->mysqli->query($add))) {
            return 'Error en la inserción';
        }
        return 'Contrato añadido con éxito'; //operacion de insertado correcta
    }

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
    function SEARCH() {
        $search = "SELECT * FROM contratos WHERE `cod` LIKE '%" . $this->cod . "%' AND `centro` LIKE '%" . $this->centro . "%' AND `tipo` LIKE '%" . $this->tipo . "%' AND `estado` LIKE '%" . $this->estado . "%' 
            AND `cifEmpresa` LIKE '%" . $this->cifEmpresa . "%' AND `documento` LIKE '%" . $this->documento . "%' AND `periodoInicio` LIKE '%" . $this->periodoInicio . "%' AND
                  `periodoFin` LIKE '%" . $this->periodoFin . "%' AND `frecuenciaVisitas` LIKE '%".$this->frecuencia."%'  AND `importe` LIKE '%" . $this->importe . "%'";
        if (!($resultado = $this->mysqli->query($search))) {
            return 'Error en la consulta';
        } else if ($resultado->numrows = 0) {
            return 'Sin resultados';
        } else {
            return $resultado;
        }
    }

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
    function DELETE() {
        $delete = "DELETE FROM `contratos` WHERE `cod`='$this->cod'";
        
        $dirDocumento = '../Files/' . $this->cod;
        if (!$this->mysqli->query($delete)) {
            return 'Error en la eliminación';
        } else {
            $this->borrarDirectorio($dirDocumento);
            return 'Eliminación realizada con éxito';
        }
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $documento = "SELECT `documento` FROM contratos WHERE `cod`='$this->cod'";
        $modeloDocumento = $this->mysqli->query($documento);
        
        $tupla = $modeloDocumento->fetch_assoc();
        $rutaDocumento = $tupla['documento'];
        
        if ($tupla['documento'] != $this->documento) {
            $this->borrarDirectorio('../Files/' . $this->cod);
            $rutaDocumento = $this->funcionRutaDocumento();
        }
        $edit = "UPDATE `contratos` SET `centro`='$this->centro',`tipo`='$this->tipo',`estado`='$this->estado',`cifEmpresa`='$this->cifEmpresa',`documento`='$rutaDocumento',"
                . "`periodoinicio`='$this->periodoInicio',`periodofin`='$this->periodoFin',`frecuenciaVisitas`='$this->frecuencia',`importe`='$this->importe' WHERE `cod`='$this->cod'";
        if (!$this->mysqli->query($edit)) { //si se da un problema en la consulta de actualización se notifica el error
            return 'Error en la actualización';
        } else {
            return 'Actualización realizada con éxito';
        }
    }

    function funcionRutaDocumento() {
        $rutaFichero = '../Files/' . $this->cod . '/' . $this->documento['name'];   //RUTA FICHERO 
        $rutaDirectorio = '../Files/' . $this->cod; //RUTA DIRECTORIO

        if (!file_exists($rutaDirectorio)) {  //Si no existe el directorio
            mkdir($rutaDirectorio, 0777, true);   //Creamos directorio con permisos de escritura, lectura y ejecucion
        }
        move_uploaded_file($this->documento['tmp_name'], $rutaFichero);     //tmp_name = RUTA ABSOLUTA DE DONDE SE SUBIO EL FICHERO
        return $rutaFichero;
    }

    function borrarDirectorio($path) {
        $files = glob($path . '/*');
        foreach ($files as $archivo) {
            is_dir($archivo) ? $this->borrarDirectorio($archivo) : unlink($archivo);
        }
        rmdir($path);
        return;
    }
    

    
    
    //Metodo para pagar un contrato
   function pagar(){
         $sql="UPDATE contratos SET `estado`='pagado' WHERE `cod`=$this->cod";
         var_dump($sql);
          $resultado=$this->mysqli->query($sql);
          if(!$resultado){
              return 'Error en la actualizacion';  
          }
          else{
              
              return 'Contrato pagado con exito';
          }
       
   }     
    
  function getCodigo(){
      global $codigoDelContrato;
      return $codigoDelContrato;
      
  }

    function getCentros(){
        $sql = "SELECT `nombre` FROM centros";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }
    
    function getEmpresas(){
        $sql = "SELECT `CIF` FROM empresas";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }    
        
}

//fin de clase
?>