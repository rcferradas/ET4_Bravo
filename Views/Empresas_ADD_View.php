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

            <form id="add" enctype="multipart/form-data" method="post" action="../Controllers/Empresas_Controller.php" onsubmit="return validarEmpresasADD(this);">
                <div class="form-group">
                    <label><span>*</span><?php echo $strings['CIF']; ?>:</label>
                    <input class="form-control" type="text" size="40" onblur="comprobarCIF(this);" id="CIFempresa" name="cif" >
                </div>
                <div class="form-group">
                    <label><span>*</span><?php echo $strings['Nombre']; ?>:</label>
                    <input class="form-control" type="text" size="40" onblur="comprobarTexto(this, 30);" id="nombreempresa" name="nombre">
                </div> 
                <div class="form-group">
                    <label><span>*</span><?php echo $strings['Tipo']; ?>:</label>
                    <select class="form-control" id="tipoempresa" name="tipo" >
                        <option value="certificador"><?= $strings['Certificadora'] ?></option>
                        <option value="mantenimiento"><?= $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?= $strings['Reparadora'] ?></option>
                    </select>
                </div> 
                <div class="form-group">
                    <label><span>*</span><?php echo $strings['Telefono']; ?>:</label>
                    <input class="form-control" type="text" id="telefonoempresa" name="telefono"  size=11 onblur="comprobarTelf(this);">
                </div>
                <div class="form-group">
                    <label><span>*</span><?php echo $strings['Localizacion']; ?>:</label>
                    <input class="form-control" type="text" size="40" onblur="comprobarTexto(this, 50);" id="localizacionempresa" name="localizacion">
                </div>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <button class="btn btn-outline-primary" name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>
            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>
