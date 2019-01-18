<!--17-01-2019/Bravo/Vista que nos permite logearnos en el sistema -->

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
            <div class="form-group">
                <label for="email"><?php echo $strings['Login'] ?></label> 
                <input id="email" class="form-control" type = 'text' name = 'login' size = '9' value = '' onblur="comprobarAlfabetico(this, 15)"  >
            </div>
            <div class="form-group">
                <label id="password"><?php echo $strings['Contraseña'] ?></label>
                <input id="password" class="form-control" type = 'password' name = 'password' size = '15' value = '' onblur="comprobarAlfabetico(this, 25)"  >
            </div>
            <input class="btn btn-primary" type='submit' name='action' value='Login'>
        </form>
        <?php
        include '../Views/Footer.php';
    }

//fin metodo render
}

//fin Login
?>
