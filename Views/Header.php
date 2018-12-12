<?php
include_once '../Functions/Authentication.php';
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'SPANISH';
} else {
    
}
include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
?>
<html>
    <head>
        <title>
            Ejemplo arquitectura IU
        </title>
        <meta charset="UTF-8">
        <title>
            <?php echo $strings['Ejemplo arquitectura IU']; ?>
        </title>
        <script type="text/javascript" src="../Views/js/tcal.js"></script> 
        <script type="text/javascript" src="../Views/js/md5.js"></script>
        <script type="text/javascript" src="../Views/js/validaciones.js"></script> 

<!--<script type="text/javascript" src="../View/js/comprobar.js"></script> -->
        <link rel="stylesheet" type="text/css" href="../Views/css/JulioCSS-2.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../Views/css/modal.css" />
    </head>
    <body>
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
                echo $strings['Portal de Gestión'];
                ?>
            </h1>
        </p>

        <div width: 50%; align="left">
             <form name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
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
                    <img src='./sign-error.png'>
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
}
?>
        <article>
