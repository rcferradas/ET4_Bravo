<?php

class Login {

    function __construct() {
        $this->render();
    }

    function render() {

        include '../Views/Header.php';
        ?>
        <h1><?php echo $strings['Login']; ?></h1>	 
        <form name = 'Form' action='../Controllers/Login_Controller.php' method='post' onsubmit="return comprobar_login();">

            login : <input type = 'text' name = 'login' placeholder = 'Utiliza tu Dni' size = '9' value = '' onblur="javi1();"  ><br>

            password : <input type = 'password' name = 'password' placeholder = 'Letras y numeros' size = '15' value = '' onblur="esNoVacio('password') && comprobarLetrasNumeros('password', 15)"  ><br>

            <input type='submit' name='action' value='Login'>

        </form>

        <?php
        include '../Views/Footer.php';
    }

//fin metodo render
}

//fin Login
?>
