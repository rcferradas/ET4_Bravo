<?php

class Centros_ADD {

    function __construct() {

        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Añadir centro']; ?></h2>        

        <section>
            <form class="form_edit" method="post" action="../Controllers/Centros_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                <fieldset id="fieldset_edit">
                    <input hidden name="cod" type="text" size="25" id="cod" value="NULL"> 

                    <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                    <input name="nombre" type="text" size="25" id="nombre" onblur="comprobarTexto(this, 30);"/> 

                    <label for="lugar"><?php echo $strings['Lugar'] ?>  *</label> 
                    <input name="lugar" type="text" size="25" id="lugar" onblur="comprobarTexto(this, 30);"/> 

                    <label for="usuarioAsignado"><?php echo $strings['Usuario asignado'] ?>  *</label> 
                    <input name="usuarioAsignado" type="text" size="25" id="usuarioAsignado" onblur="comprobarTexto(this, 30);"/> 

                <!--                    <select id="tipo" name="tipo">
                                        <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                                        <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                                        <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                                    </select>-->

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                <!-- Boton submit -->
                <button name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

