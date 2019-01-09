<?php

class Empresas_SEARCH_View {

    function __construct() {
        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Buscar empresas']; ?></h2>        

        <section>
            <form class="form_edit" method="post" action="../Controllers/Empresas_Controller.php" enctype="multipart/form-data">
                <fieldset id="fieldset_edit">

                    <label for="cif"><?php echo $strings['CIF'] ?>  *</label> 
                    <input name="cif" type="text" size="25" id="cif" onblur="comprobarTexto(this, 30);"/> 
                    <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                    <input name="nombre" type="text" size="25" id="nombre" onblur="comprobarTexto(this, 30);"/> 

                    <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                    <select name="tipo" id="tipo">
                        <option value=""></option>
                        <option value="certificador"><?php echo $strings['Certificadora'] ?></option>
                        <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?php echo $strings['Reparadora'] ?></option>
                    </select>
                    <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                    <input name="telefono" type="text" size="25" id="telefono" onblur="comprobarTexto(this, 30);"/> 

                    <label for="localizacion"><?php echo $strings['Localizacion'] ?>  *</label> 
                    <input name="localizacion" type="text" size="25" id="localizacion" onblur="comprobarTexto(this, 30);"/> 

                </fieldset>
                <!-- Boton submit -->
                <button name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

