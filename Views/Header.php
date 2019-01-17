<?php
include_once '../Functions/Authentication.php';
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'SPANISH';
} else {
    
}
include_once '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
?>
<html>
    <head>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/estilo.css" media="screen" />
        <script type="text/javascript" src="../Views/js/validaciones.js" language="Javascript"></script>
        <script type="text/javascript" src="../Views/js/tcal.js" language="Javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>
            Equipo Bravo
        </title>
        <meta charset="UTF-8">
        <title>
            <?php echo $strings['Equipo Bravo']; ?>
        </title>
        <script type="text/javascript" src="../Views/js/tcal.js"></script> 
        <script type="text/javascript" src="../Views/js/md5.js"></script>
        <script type="text/javascript" src="../Views/js/validaciones.js"></script> 

<!--<script type="text/javascript" src="../View/js/comprobar.js"></script> -->
        <link rel="stylesheet" type="text/css" href="../Views/css/JulioCSS-2.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/modal.css" />
    </head>
    <body style="background-color: darkgray">
        <div id="modal" style="display:none">
            <div id="contenido-interno">
                <div id="aviso"><img src="../Views/Icons/sign-error.png" name="aviso"/></div>
                <div id="mensajeError"></div>
                <a id="cerrar" href="#" onclick="cerrarModal();">
                    <img style="cursor: pointer" alt="" src="../Views/Icons/salir.png" width="25"/>
                </a>
            </div>
        </div>
        <header>
            <p style="text-align:center">
            <h1>
                <?php
                echo $strings['Equipo Bravo'];
                ?>
            </h1>
        </p>

        <div width: 50%; align="left">
             <form  name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
                 <div class="form-group">
                 <label for="idioma"><?php echo $strings['idioma']; ?></label>
                 <select id="idioma" class="form-control" name="idioma" onChange='this.form.submit()'>
                    <option></option>
                    <option value="SPANISH"><?php echo $strings['ESPAÑOL']; ?></option>
                    <option value="GALLAECIAN"><?php echo $strings['GALLEGO']; ?></option>
                    <option value="ENGLISH"><?php echo $strings['INGLES']; ?></option>
                </select>
                 </div>
            </form>
        </div>
        <?php
        if (IsAuthenticated()) {
            ?>
        <span>
            <?php
            echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>';
            ?>
        </span>
            <div width: 50%; align="right">
                 <a href='../Functions/Desconectar.php'>
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>

            <?php
        } else {
            echo $strings['Usuario no autenticado'];
            /* echo 	'<form name=\'registerForm\' action=\'../Controller/Register_Controller.php\' method=\'post\'>
              <input type=\'submit\' name=\'action\' value=\'REGISTER\'>
              </form>'; */
            ?>
            <?php
        }
        ?>


    </header>

    <div id = 'main'>
        <?php
//session_start();
        if (IsAuthenticated()) {
            include '../Views/users_menuLateral.php';
        }
        ?>
        <article>
