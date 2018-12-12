<?php
include_once '../Functions/Authentication.php';
include_once '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'SPANISH';
} else {
    
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" media="screen" />
        <script type="text/javascript" src="../Views/js/validaciones.js" language="Javascript"></script>
        <script type="text/javascript" src="../Views/js/tcal.js" language="Javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>
            Portal de mantenimiento
        </title>
        <meta charset="UTF-8">
        <title>
            <?php echo $strings['Portal de mantenimiento']; ?>
        </title>
        <script type="text/javascript" src="../Views/js/tcal.js"></script> 
        <script type="text/javascript" src="../Views/js/md5.js"></script>
        <script type="text/javascript" src="../Views/js/validaciones.js"></script> 

<!--<script type="text/javascript" src="../View/js/comprobar.js"></script> -->
        <link rel="stylesheet" type="text/css" href="../Views/css/JulioCSS-2.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/modal.css" />
    </head>
    <body style="background-color: gray">
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
                echo $strings['Portal de mantenimiento'];
                ?>
            </h1>
        </p>

        <div width: 50%; align="left">
             <form  name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
                     <?php echo $strings['idioma']; ?>
                <select name="idioma" onChange='this.form.submit()'>
                    <option value="SPANISH"> </option>
                    <option value="ENGLISH"><?php echo $strings['INGLES']; ?></option>
                    <option value="SPANISH"><?php echo $strings['ESPAÑOL']; ?></option>
                </select>
            </form>
        </div>
        <?php
        if (IsAuthenticated()) {
            ?>

            <?php
            echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>';
            ?>			
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
            <a href='../Controllers/Register_Controller.php'>Registrar</a>
            <?php
        }
        ?>


    </header>

    <div id = 'main'>
        <?php
//session_start();
        if (IsAuthenticated()) {
            include '../Views/users_menuLateral.php';
            include '../Models/Contratos_Model.php';
            include '../Views/Contrato_SHOWALL_View.php';
            
            $datos = new Contratos_Model();
            $resultado = $datos->showAll();
            if ($resultado->num_rows > 0) {
                new Contrato_SHOWALL($resultado);
            } else {
                echo 'No hay contratos';
//        new MESSAGE("No hay tuplas", './Login_Controller.php');
            }
        }
        ?>
        <article>
