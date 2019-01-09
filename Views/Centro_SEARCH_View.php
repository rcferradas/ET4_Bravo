<?php

class Centro_SEARCH {

    function __construct() {
        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Buscar contratos']; ?></h2>        

        <section>
            <form class="form_edit" method="post" action="../Controllers/Centros_Controller.php" enctype="multipart/form-data">
                <fieldset id="fieldset_edit">

                    <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                    <input name="nombre" type="text" size="25" id="nombre" onblur="comprobarTexto(this, 30);"/> 
                    
                    <label for="lugar"><?php echo $strings['Lugar'] ?>  *</label> 
                    <input name="lugar" type="text" size="25" id="lugar" onblur="comprobarTexto(this, 30);"/> 
                    
                    <label for="usuarioAsignado"><?php echo $strings['Usuario asignado'] ?>  *</label> 
                    <input name="usuarioAsignado" type="text" size="25" id="usuarioAsignado" onblur="comprobarTexto(this, 30);"/> 

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                <!-- Boton submit -->
                <button name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

