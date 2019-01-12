<?php



class VISITAS_Model {

    var $codVisita;
    var $estado;
    var $tipo;
    var $codContrato;
    var $informe;
    var $fecha;
    var $visitaPadre;
    var $mysqli;

//Constructor de la clase
    
    function __construct(){
        //obtengo un array con los parámetros enviados a la función
		$parametros = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_parametros = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre de
		//función
		$funcion_usada ='__construct'."$num_parametros";
               
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_usada)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
  
                    call_user_func_array(array($this,$funcion_usada),$parametros);
		}
        
        
    }
    
    
    
    
    function __construct2($tipo, $codContrato) {
        $this->tipo = $tipo;
        $this->codContrato = $codContrato;
        
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }



//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADDPeriodicas() {     
        $this->fecha=$this->fecha->format('Y-m-d');
         $sql ="INSERT INTO visitas (
             `codVisita`, 
             `tipo`, 
             `codContrato`, 
             `fecha`
              ) 
        VALUES ('$this->codVisita', '$this->tipo', '$this->codContrato', 
                '$this->fecha'
                 )";
          $resultado=$this->mysqli->query($sql);
    }


 //funcion SHOWALL: recupera todos los registros de la tabla VISITAS 
    function SHOWALL() {
        $sql = "SELECT * FROM VISITAS";
        $resultado;
        

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Tabla vacia';
        } else {
            
            return $resultado; //devolvemos el array asociativo
        }
    }
    
    
    
    //funcion DELETE : comprueba que la tupla a borrar existe y una vez 
   // verificado la borra.
    function DELETE() {
        $sql = "SELECT * FROM VISITAS WHERE (`codVisita` = '" . $this->codVisita . "')";
        $resultado = $this->mysqli->query($sql);
        
        if($resultado->num_rows == 1){
            $sql="DELETE FROM VISITAS WHERE ( `codVisita` = '".$this->codVisita."')";
            if (!($this->mysqli->query($sql))) {
                return 'Error, no se ha podido borrar la tupla';
            }
        }else{
            return 'No existe dicha tupla';
        }
    }

    
    
    function SHOWCURRENT() {
        $sql="SELECT * FROM VISITAS WHERE(`codVisita` = '".$this->codVisita."')";
        $resultado = $this->mysqli->query($sql);
        
        if($resultado->num_rows == 1){
            $tupla = $resultado->fetch_array();
            return $tupla;
        }else{
            return 'No existe dicha tupla';
        }
    }


    



// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $sql = "SELECT * FROM VISITAS WHERE (`codVisita`= '".$this->codVisita."')";
        $resultado = $this->mysqli->query($sql);
        
        if($resultado->num_rows == 1){
             
            if(isset($this->informe['name'])){
          
                $this->eliminarInforme('../Files/'. $this->codVisita .'/Inf/');
                $resguardo = $this->rutaInforme();
            
            }else{
                $resguardo = $this->informe;
            }
            $sql = "UPDATE VISITAS
                    SET `estado` = '$this->estado', `tipo`= '$this->tipo', `codContrato`= '$this->codContrato', `informe` = '$this->informe',
                     `fecha` = '$this->fecha', `frutoVisitaProg`= '$this->visitaPadre'
                    WHERE ( `codVisita` = '$this->codVisita' )
                 ";
            
            if (!$this->mysqli->query($sql)) { //si se da un problema en la consulta de actualización se notifica el error
                return 'Error en la actualización';
            } else {
                return 'Actualización realizada con éxito';
            }
        }else{
            return 'No existe dicha tupla';
        }
    }


function datosContrato(){
    $sql = "SELECT DATE_FORMAT(`periodoinicio`, '%Y-%m-%d'),DATE_FORMAT(`periodofin`, '%Y-%m-%d'),`frecuenciaVisitas` FROM CONTRATOS WHERE (`cod`= '$this->codContrato')";
     $resultado = $this->mysqli->query($sql);
    
      if($resultado->num_rows == 1){
          $tupla = $resultado->fetch_array();
          return $tupla;
      }
      if (!$this->mysqli->query($sql)) { 
          return 'Error en la consulta';
      }
   
      else{
          return 'No se ha encontrado la tupla';
      }
}




function crearVisitasPeriodicas($datosContrato){
    $contador=0;
    $fechaVis = DateTime::createFromFormat('Y-m-d', $datosContrato[0]);
    $endf= DateTime::createFromFormat('Y-m-d',$datosContrato[1]);
    $stringFrec= VISITAS_Model::cadenaFrecuencia($datosContrato[2]);   
     do{
         $contador++;
         date_add($fechaVis, date_interval_create_from_date_string($stringFrec));
         $this->fecha=$fechaVis;
         $this->codVisita= substr($this->codContrato,0,4).$contador;
         $resultado=$this->ADDPeriodicas();
         
     }
    while($fechaVis < $endf);
           
        
} 
       static function cadenaFrecuencia($frec){
            
              switch ($frec){
                  
                 case 'diaria':
                     $frec='1 day';
                     break;
      
                 case 'semanal':
                    $frec='1 week';
                    break;
            
                 case 'mensual':
                    $frec='1 month';
                    break;
        
                 case 'trimestral':
                    $frec='3 months';
                     break;
        
                case 'anual':
                    $frec='1 year';
                    break;
        
                case 'quinquenal':
                    $frec='5 years';
                    break;
            
        
              }
            
          return  $frec;   
                
        }

	function rutaInforme(){
            $ruta = '../Files/'.$this->codVisita . '/Inf/'.$this->informe['name'];
            $rutaDirectorio = '../Files/'. $this->codVisita .'/Inf/';

            if(!file_exists($rutaDirectorio)){
                mkdir($rutaDirectorio,0777,true);
             }
             
            move_uploaded_file($this->informe['tmp_name'], $ruta);
           
            return $ruta;
            
        }
		
        function eliminarInforme($path) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
               is_dir($file) ? eliminarResguardo($file) : unlink($file);
             }
             
            rmdir($path);
            return;
       }
}



?>


