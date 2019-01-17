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

//Constructor de la clase con sobrecarga simulada, según el número de argumentos,
//llamará a uno o otro método constructor.
    
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
    
    
    
    //Constructor de la clase para crear las visitas de tipo periódico.
    //Recibe el tipo de la visita, y el código del contrato que se ha creado.
    function __construct2($tipo, $codContrato) {
        $this->tipo = $tipo;
        $this->codContrato = $codContrato;
        
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }
    
    //Constructor de la clase para crear las visitas de tipo periódico.
    //Recibe el tipo de la visita, y el código del contrato que se ha creado.
    function __construct1($codContrato) {
        $this->codContrato = $codContrato;
        
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }    
    
     //Constructor de la clase para crear las visitas de tipo periódico.
    //Recibe el tipo de la visita, y el código del contrato que se ha creado.
    function __construct3($codVisita,$codContrato,$fecha) {
     
        $this->codVisita= $codVisita;
        $this->codContrato = $codContrato;
        $this->fecha= $fecha;
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }     
    
   //Constructor de la clase para crear las visitas de tipo periódico.
    //Recibe el tipo de la visita, y el código del contrato que se ha creado.
    function __construct4($codVisita,$codContrato,$fecha,$informe) {
     
        $this->codVisita= $codVisita;
        $this->codContrato = $codContrato;
        $this->fecha= $fecha;
        $this->informe=$informe;
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }     
    
      //Constructor de la clase para crear las visitas de tipo periódico.
    //Recibe el tipo de la visita, y el código del contrato que se ha creado.
    function __construct5($estado,$tipo,$codContrato,$informe,$fecha) {
     
        $this->estado= $estado;
        $this->tipo = $tipo;
        $this->codContrato= $codContrato;
        $this->informe= $informe;
        $this->fecha= $fecha;
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }         
    
    function __construct6($estado,$tipo,$codContrato,$informe,$fecha,$visitaPadre) {
     
        $this->estado= $estado;
        $this->tipo = $tipo;
        $this->codContrato= $codContrato;
        $this->informe= $informe;
        $this->fecha= $fecha;
        $this->visitaPadre=$visitaPadre;
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }         
    
    function __construct7($codVisita,$estado,$tipo,$codContrato,$informe,$fecha,$visitaPadre) {
        $this->codVisita=$codVisita;
        $this->estado= $estado;
        $this->tipo = $tipo;
        $this->codContrato= $codContrato;
        $this->informe= $informe;
        $this->fecha= $fecha;
        $this->visitaPadre=$visitaPadre;
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }    
    
//Metodo ADD
//Inserta en la tabla  de la bd  las visitas periódicas con los atributos:
// PK de la visita, tipo, codigo del contrato al que pertenecen y la fecha en la
// que deben realizarse.
    
    function ADDPeriodicas() {     
        $this->fecha=$this->fecha->format('Y-m-d'); //Convierte el objeto DateTime en un string con el formato señalado
         $sql ="INSERT INTO visitas (
             `codVisita`,
             `estado`,
             `tipo`, 
             `codContrato`, 
             `fecha`
              ) 
        VALUES ('$this->codVisita', 'pendiente','$this->tipo', '$this->codContrato', 
                '$this->fecha'
                 )";
          $resultado=$this->mysqli->query($sql);
    }
    
    
    
    
     
    function ADDNoProgramadas() {     
        $max="SELECT MAX(`codVisita`)as codigo FROM `visitas` WHERE(`codContrato` = $this->codContrato)";
        $res=$this->mysqli->query($max);
        $tupla=$res->fetch_assoc();
        $codigovis= $tupla['codigo'];
        $indice= strlen($this->codContrato);
        $numeroVisita= substr($codigovis, $indice)+1;
        $this->codVisita= $this->codContrato.$numeroVisita;
        if($_FILES['informe']['size'] != 0){
            $rutainf= $this->rutaInforme();
        }
        $rutainforme= $_FILES['informe']['size'] != 0? "'$rutainf'":'NULL';
        $this->visitaPadre=  !empty($this->visitaPadre)? "'$this->visitaPadre'": "NULL";
        $sql ="INSERT INTO visitas (
             `codVisita`,
             `estado`,
             `tipo`, 
             `codContrato`, 
             `informe`,
             `fecha`,
             `frutoVisitaProg`
              ) 
        VALUES ('$this->codVisita','$this->estado', '$this->tipo', '$this->codContrato', 
                $rutainforme,'$this->fecha',$this->visitaPadre
                 )";
          $resultado=$this->mysqli->query($sql);
          
           if (!$resultado) {
            return 'Error en la inserción';
        }
        return 'Visita añadida con éxito'; //operacion de insertado correcta
    }


 //funcion SHOWALL: recupera todos los registros de la tabla VISITAS 
    function SHOWALL() {
        $sql = "SELECT * FROM visitas";
        $resultado=$this->mysqli->query($sql);
        

        if (!($resultado)) { //si no hay tuplas, el resultado de la consulta será falso
            return 'Tabla vacia';
        } else {
            
            return $resultado; //devolvemos el array asociativo
        }
    }
    
    //funcion que coge todos los registro de visitas relacionados con un contrato
    
    function showVisitas($codigoCon,$frec){
        $interval= VISITAS_Model::cadenaIntervalo($frec);
        $sql = "SELECT * FROM visitas WHERE (`codContrato` = '$codigoCon'
                 AND `fecha` >= DATE_SUB(NOW(), $interval) AND `fecha`<=
                DATE_ADD(NOW(),$interval))ORDER BY `fecha` LIMIT 20";
        $resultado = $this->mysqli->query($sql);
        
        if (!($resultado)) { //si se produce un error en la consulta
            return 'Error en la consulta';
        }
        else if($resultado->num_rows ==0){
            $sql = "SELECT * FROM VISITAS WHERE (`codContrato` = '$codigoCon')
                ORDER BY `fecha` LIMIT 20";
               $resultado = $this->mysqli->query($sql);
            
            return $resultado;
            
        }
        else {
            
            return $resultado; //devolvemos el array asociativo
        }
    }
    
    
    //funcion DELETE : comprueba que la tupla a borrar existe y una vez 
   // verificado la borra.
    function DELETE() {
        $sql = "DELETE FROM visitas WHERE (`codVisita` = '" . $this->codVisita . "')";
        $dirDocumento = '../Files/' . $this->codVisita;
        if (!$this->mysqli->query($sql)) {
            return 'Error en la eliminación';
        } else { 
            if(!empty($this->informe) && file_exists('../Files/'.$this->codVisita . '/Inf/'.$this->informe)){
           $this->borrarDirectorio($dirDocumento);
            }
           return 'Eliminación realizada con éxito';
        }
    }

    
    //Devuelve una tupla con todos los atributos de una visita concreta,
    //o un mensaje en caso de que no haya ninguna tupla con el codigo de visita
    // de la consulta
    
    function SHOWCURRENT() {
        $sql="SELECT * FROM visitas WHERE(`codVisita` = '".$this->codVisita."')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){ //Si el resultado de la consulta es una tupla, devuelve dicha tupla como un array asociativo
            $tupla = $resultado->fetch_array();
            return $tupla;
        }else{ 
            return 'No existe dicha tupla';
        }
    }


    



// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $sql = "SELECT `informe` FROM visitas WHERE (`codVisita`= '".$this->codVisita."')";
        $resultado = $this->mysqli->query($sql);
        $viejoinforme=$resultado->fetch_assoc();
        $rutaviejostr=(string) $viejoinforme['informe'];
        if($resultado->num_rows == 1){ //Si se encuentra la tupla buscada en la consulta, se procede con el update
             
           if($_FILES['informe']['size'] != 0){ //Comprueba si el campo informe del formulario ha sido rellenado
                 if(!empty($viejoinforme['informe'] && file_exists($rutaviejostr) )){
                     
                    $this->borrarDirectorio('../Files/'. $this->codVisita.'/Inf/'); //Elimina el informe previamente asociado
                     }
                $informe = $this->rutaInforme(); //Añade el informe en el directorio destino, y guarda la ruta en una nueva variable
                $informestr= "'$informe'";
            }else{
                 
                $informe = $viejoinforme['informe'];//La variable que actualiza el atributo informe conserva su antiguo valor, en caso contrario
                $informestr=  "'$informe'";
              }
                    $sql = "UPDATE visitas
                    SET `estado` = '$this->estado', `tipo`= '$this->tipo',`informe` = $informestr,
                     `fecha` = '$this->fecha'
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
    
    
    
    
  function SEARCH($fecha1,$fecha2){
             
            $fechas = "SELECT `periodoinicio`,`periodofin` FROM contratos WHERE `cod`=$this->codContrato";
            $resultado= $this->mysqli->query($fechas);
            if(!$fechas){
                return 'Error en la consulta';
            }else{
                $rango=$resultado->fetch_assoc();
            }
            if($fecha1==''){
                $fechainicio=$rango['periodoinicio'];
            }else{
                 $fechainicio=$fecha1;
            }
              if($fecha2==''){
                $fechafin=$rango['periodofin'];
            }else{
                 $fechafin=$fecha2;
            }
          $padre= $this->visitaPadre!='' ? ' AND `frutoVisitaProg` IS NOT NULL':'';
      
      
         $search = "SELECT * FROM visitas WHERE `estado` LIKE '%" . $this->estado . "%' AND `tipo` LIKE '%" . $this->tipo . "%'  
            AND `codContrato` LIKE '%" . $this->codContrato . "%' AND `fecha` >= '$fechainicio' AND `fecha` <= '$fechafin' 
                     $padre ORDER BY `fecha` LIMIT 20";
        if (!($resultado = $this->mysqli->query($search))) {
            return 'Error en la consulta';
        } else if ($resultado->numrows = 0) {
            return 'Sin resultados';
        } else {
            return $resultado;
        }
      
      
      
      
      
      
      
  }  
    
    
    
    
    

//Funcion que devuelve una array con la fecha de inicio, fecha de fin, y la frecuencia
//del contrato con el que se relacionan las visitas periódicas.
    
function datosContrato(){
    $sql = "SELECT DATE_FORMAT(`periodoinicio`, '%Y-%m-%d'),DATE_FORMAT(`periodofin`, '%Y-%m-%d'),`frecuenciaVisitas` FROM contratos WHERE (`cod`= '$this->codContrato')";
    $resultado = $this->mysqli->query($sql);
    
    if (!$resultado) { //Si la consulta falla devuelve un mensaje de error
          return 'Error en la consulta';
      }
      if($resultado->num_rows == 1){ //Si el resultado es una tupla, crea una array con los datos y los devuelve
          $tupla = $resultado->fetch_array();
          return $tupla;
      }
      
      else{ //Si no se encuentra tuplas, se devuelve un mensaje
          return 'No se ha encontrado la tupla';
      }
}


//Funcion que a partir de los datos de un contrato(fecha de inicio, fecha de fin,
//y frecuencia) crea visitas periodicas.

    function crearVisitasPeriodicas($datosContrato){
        $contador=0; //Variable que nos ayuda a crear un codigo de visita
        $fechaVis = DateTime::createFromFormat('Y-m-d', $datosContrato[0]); //Fecha donde comienza el contrato
        $endf= DateTime::createFromFormat('Y-m-d',$datosContrato[1]); //Variable con la fecha donde concluye el contrato
        $stringFrec= VISITAS_Model::cadenaFrecuencia($datosContrato[2]);   //String con la frecuencia a la que actualizaremos la fecha de cada visita
         while($fechaVis < $endf){ //Mientras la fecha actualizada para las nuevas visitas no supere la fecha de fin del contrato, se añadiran mas visitas
         
             $contador++;
             $this->fecha=$fechaVis; //Actualizamos la fecha del objeto de la clase
             $this->codVisita= substr($this->codContrato,0,4).$contador; //Creamos el codigo de la visita a partir de el del contrato y la variable incremental
             $resultado=$this->ADDPeriodicas();//Añadimos las visita con el ADD correspondiente
             date_add($fechaVis, date_interval_create_from_date_string($stringFrec)); //Actualizamos la fecha con la frecuencia dada//Añadimos la visita a la base de datos
         }
     
           
        
} 


//Funcion estatica que transforma un string con la frecuencia sacada del atributo
// frecuenciaVisitas de la tabla contratos, en una cadena que permite actualizar
//la fecha de las visitas periódicas con el udo de date_add()


    static function cadenaFrecuencia($frec){
            
              switch ($frec){ //comprueba que caso se cumple, y devuelve una variable con una cadena
                  
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
        
        
        
            static function cadenaIntervalo($frec){
              $interval='';
                
              switch ($frec){ //comprueba que caso se cumple, y devuelve una variable con una cadena
                  
                 case 'diaria':
                     $interval='INTERVAL 10 DAY';
                     break;
      
                 case 'semanal':
                    $interval='INTERVAL 10 WEEK';
                    break;
            
                 case 'mensual':
                    $interval='INTERVAL 10 MONTH';
                    break;
        
                 case 'trimestral':
                    $interval='INTERVAL 30 MONTH';
                     break;
        
                case 'anual':
                    $interval='INTERVAL 10 YEAR';
                    break;
        
                case 'quinquenal':
                    $interval='INTERVAL 50 YEAR';
                    break;
            
        
              }
            
          return  $interval;   
                
        }


    //Funcion que guarda el informe de una visita en un nuevo(o no) directorio.
    //Devuelve la ruta del informe
        
        
	function rutaInforme(){
            $ruta = '../Files/'.$this->codVisita . '/Inf/'.$this->informe['name']; //Variable con la ruta del informe
            $rutaDirectorio = '../Files/'. $this->codVisita .'/Inf/'; //Variable con la ruta del directorio donde colocaremos el informe

            if(!file_exists($rutaDirectorio)){ //Si no existe el directorio, este se crea
                mkdir($rutaDirectorio,0777,true);
             }
             
            move_uploaded_file($this->informe['tmp_name'], $ruta); // Se sube el informe al nuevo directorio
           
            return $ruta;
     
        }
        
    //Funcion que elimina el informe dada na ruta como parametro
        
           function borrarDirectorio($path) {
        $files = glob($path . '/*');
        foreach ($files as $archivo) {
            is_dir($archivo) ? $this->borrarDirectorio($archivo) : unlink($archivo);
        }
        rmdir($path);
        return;
    }
}



?>


