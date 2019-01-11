
<?php

//Clase : USUARIOS_Modelo
//Creado el : 22-09-2017
//Creado por: jrodeiro
//-------------------------------------------------------

class USUARIOS_Model {

    var $login;
    var $password;
    var $DNI;
    var $nombre;
    var $apellidos;
    var $telefono;
    var $email;
    var $rol;
    var $mysqli;

//Constructor de la clase

    function __construct($login, $password, $dni, $nombre, $apellidos, $telefono, $email, $rol) {
        $this->login = $login;
        $this->password = $password;
        $this->DNI = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->rol = $rol;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
    function ADD() {
        $sql = "INSERT INTO USUARIOS VALUES('$this->login',"
                . "'$this->password',"
                . "'$this->DNI',"
                . "'$this->nombre',"
                . "'$this->apellidos',"
                . "'$this->telefono',"
                . "'$this->email',"
                . "'$this->rol')
                 ";
    }

    //funcion SHOWALL: recupera una proyección de 3 atributos 
    //de todas las tuplas de la tabla
    function SHOWALL() {
        $sql = "SELECT * FROM USUARIOS";
        $resultado;

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Tabla vacia';
        } else {

            return $resultado; //devolvemos el array asociativo
        }
    }

//cierre funcion
//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos

    function SEARCH() {
        $sql = "SELECT * FROM USUARIOS
                    WHERE `login` LIKE '%" . $this->login . "%' AND `password` LIKE '%" . $this->password . "%' AND `DNI` LIKE '%" . $this->DNI . "%'
                    AND `nombre` LIKE '%" . $this->nombre . "%' AND `apellidos` LIKE '%" . $this->apellidos . "%' AND `telefono` LIKE '%" . $this->telefono . "%' AND
                    `email` LIKE '%" . $this->email . "%' AND `rol` LIKE '%" . $this->rol . "%'
                ";

        $resultado;

        if (!($resultado = $this->mysqli->query($sql))) {
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
        $sql = "SELECT * FROM USUARIOS WHERE (`login` = '" . $this->login . "')";
        $resultado = $this->mysqli->query($sql);

        if ($resultado->num_rows == 1) {
            $sql = "DELETE FROM USUARIOS WHERE ( `login` = '" . $this->login . "')";
            if (!($this->mysqli->query($sql))) {
                return 'Error, no se ha podido borrar la tupla';
            }
        } else {
            return 'No existe dicha tupla';
        }
        return 'Eliminación realizada con éxito';
    }

// funcion SHOWCURRENT: recupera todos los atributos de una tupla a partir de su clave
    function SHOWCURRENT() {
        $sql = "SELECT * FROM USUARIOS WHERE(`login` = '" . $this->login . "')";
        $resultado = $this->mysqli->query($sql);

        if ($resultado->num_rows == 1) {
            $tupla = $resultado->fetch_array();
            return $tupla;
        } else {
            return 'No existe dicha tupla';
        }
    }
    // funcion SHOWCURRENT: recupera todos los atributos de una tupla a partir de su clave
    function getRol() {
        $sql = "SELECT * FROM USUARIOS WHERE(`login` = '" . $this->login . "')";
        $resultado = $this->mysqli->query($sql);

        if ($resultado->num_rows == 1) {
            $tupla = $resultado->fetch_array();
            return $tupla['rol'];
        } else {
            return 'No existe dicha tupla';
        }
    }

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
    function EDIT() {
        $sql = "SELECT * FROM USUARIOS WHERE (`login`= '" . $this->login . "')";
        $resultado = $this->mysqli->query($sql);

        if ($resultado->num_rows == 1) {
            $sql = "UPDATE USUARIOS
                    SET `password` = '$this->password', `DNI`= '$this->DNI', `nombre`= '$this->nombre', `apellidos` = '$this->apellidos',
                     `telefono` = '$this->telefono',`email` = '$this->email', `rol`= '$this->rol'
                    WHERE ( `login` = '$this->login' )
                 ";

            if (!$this->mysqli->query($sql)) { //si se da un problema en la consulta de actualización se notifica el error
                return 'Error en la actualización';
            } else {
                return 'Actualización realizada con éxito';
            }
        } else {
            return 'No existe dicha tupla';
        }
    }

// funcion login: realiza la comprobación de si existe el usuario en la bd y despues si la pass
// es correcta para ese usuario. Si es asi devuelve true, en cualquier otro caso devuelve el 
// error correspondiente
    function login() {

        $sql = "SELECT *
			FROM USUARIOS
			WHERE (
				(login = '$this->login') 
			)";

        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 0) {
            return 'El login no existe';
        } else {
            $tupla = $resultado->fetch_array();
            if ($tupla['password'] == $this->password) {
                return true;
            } else {
                return 'La password para este usuario no es correcta';
            }
        }
    }

//fin metodo login
    //funcion Resgister(), comprueba si el usuario existe ya en la base de datos o no
    function Register() {

        $sql = "select * from USUARIOS where login = '" . $this->login . "'";

        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {  // existe el usuario
            return 'El usuario ya existe';
        } else {
            return true; //no existe el usuario
        }
    }

    function registrar() {

        $sql = "INSERT INTO USUARIOS VALUES (
					'" . $this->login . "',
					'" . $this->password . "',
					'" . $this->DNI . "',
					'" . $this->nombre . "',
					'" . $this->apellidos . "',
                                        '" . $this->telefono . "',
                                        '" . $this->email . "',
                                        '" . $this->rol . "'
					)";

        if (!$this->mysqli->query($sql)) {
            return 'Error en la inserción';
        } else {
            return 'Inserción realizada con éxito'; //operacion de insertado correcta
        }
    }

}

//fin de clase
?> 