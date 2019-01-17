<!--17-01-2019/Bravo/Función que nos permite conectarnos y utilizar la base de datos o nos muestra si hay un fallo al conectarse -->

<?php

//----------------------------------------------------
// DB connection function
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------


function ConnectDB() {
    $mysqli = new mysqli("localhost", 'iu2018', 'pass2018', 'IU2018');

    if ($mysqli->connect_errno) {
        include './MESSAGE_View.php';
        new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');
        return false;
    } else {
        return $mysqli;
    }
}

?>
