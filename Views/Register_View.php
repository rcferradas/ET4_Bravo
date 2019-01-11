<?php

class Register {

    function __construct() {
        $this->render();
    }

    function render() {

        include '../Views/Header.php'; //header necesita los strings
        ?>
        <h1><?php echo $strings['Registro']; ?></h1>	
        <form name = 'Form' action='../Controllers/Register_Controller.php' method='post' onsubmit="return comprobar_registro();"">

            <?php echo $strings['Login']?> : <input type = 'text' name = 'login' id = 'login' size = '9' value = '' onblur="esNoVacio('login') && comprobarDni('login')" >
            <?php echo $strings['Contraseña']?> : <input type = 'text' name = 'password' id = 'password' size = '15' value = '' onblur="esNoVacio('password') && comprobarLetrasNumeros('password', 15)" >
            <?php echo $strings['DNI'] ?> : <input type='text' name='DNI' id='DNI' size='9' value='' onblur=''> <!--FALTA VALIDACION JS -->
            <?php echo $strings['Nombre']?> : <input type = 'text' name = 'nombre' id = 'nombre' size = '30' value = '' onblur="esNoVacio('nombre') && comprobarSoloLetras('nombre', 30)" >
            <?php echo $strings['Apellidos']?> : <input type = 'text' name = 'apellidos' id = 'apellidos' size = '50' value = '' onblur="esNoVacio('apellidos') && comprobarSoloLetras('apellidos', 50)" >
            <?php echo $strings['Telefono'] ?> : <input type='text' name='telefono' id='telefono' size='11' value='' onblur=''> <!--FALTA VALIDACION JS -->
            <?php echo $strings['Email']?> : <input type = 'text' name = 'email' id = 'email' size = '50' value = '' onblur="esNoVacio('email') && comprobarEmail('email')" >
            <?php echo $strings['Rol']?> : <select name="rol"> <option value='centro'><?php echo $strings['Centro']?></option></select>
            
            <input type='submit' name='action' value='REGISTER'>

        </form>


        <a href='../Controllers/Index_Controller.php'>Volver </a>

        <?php
        include '../Views/Footer.php';
    }

//fin metodo render
}

//fin REGISTER
?>

