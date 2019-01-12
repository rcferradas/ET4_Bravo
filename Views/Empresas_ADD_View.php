<?php

class Empresas_ADD_View {

    function __construct() {

        $this->pinta();
    }

    function pinta() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <section>
            <h2><?php echo $strings['Añadir empresa']; ?></h2>        

            <form id="add" enctype="multipart/form-data" method="post" action="../Controllers/Empresas_Controller.php" onsubmit="return validarEmpresa(this);">
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['CIF']; ?>:</label>
                    <input type="text" size="40" onblur="comprobarExpresionRegular(this, /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/, 10);" id="CIFempresa" name="cif" >
                </div>
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Nombre']; ?>:</label>
                    <input type="text" size="40" onblur="comprobarTexto(this, 30);" id="nombreempresa" name="nombre">
                </div> 
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Tipo']; ?>:</label>
                    <select id="tipoempresa" name="tipo" >
                        <option value="certificador"><?= $strings['Certificadora'] ?></option>
                        <option value="mantenimiento"><?= $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?= $strings['Reparadora'] ?></option>
                    </select>
                </div> 
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Telefono']; ?>:</label>
                    <input type="text" id="telefonoempresa" name="telefono"  size=11 onblur="comprobarTelf(this);">
                </div>
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Localizacion']; ?>:</label>
                    <input type="text" size="40" onblur="comprobarTexto(this, 50);" id="localizacionempresa" name="localizacion">
                </div>
                <button class="btn" name="action" value="ADD" type="submit" class="boton-env">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>
