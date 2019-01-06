<?php

class Empresas_EDIT_View {

    function __construct($empresas) {

        $this->pinta($empresas);
    }

    function pinta($empresas) {

        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <section>

            <h2><?php echo $strings['Editar empresa']; ?></h2>        
            <?php ?>

            <form id="edit" enctype="multipart/form-data" method="post" action="../Controllers/Empresas_Controller.php" onsubmit="return validarEmpresa(this);">
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['CIF']; ?>:</label>
                    <input readonly type="text" value="<?php echo $empresas[0]; ?>" size="40" onblur="comprobarExpresionRegular(this, /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/, 10);" id="CIFempresa" name="CIF" >                 
                </div>
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Nombre']; ?>:</label>
                    <input type="text" size="40" value="<?php echo $empresas[1]; ?>" onblur="comprobarTexto(this, 30);" id="nombreempresa" name="nombre">
                </div> 
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Tipo']; ?>:</label>
                    <select id="tipoempresa" name="tipo" >
                        <option value=''></option>
                        <option value="certificador"><?= $strings['Certificadora'] ?></option>
                        <option value="mantenimiento"><?= $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?= $strings['Reparadora'] ?></option>
                    </select>
                </div>
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Tipo']; ?>:</label>
                    <select id="tipoempresas" name="tipo" required >
                        <?php if ($loteria[2] == $strings['certificador']) {
                            ?>
                            <option value="certificador" selected><?= $strings['Certificadora'] ?></option>
                            <option value="mantenimiento"><?= $strings['Mantenimiento'] ?></option>
                            <option value="reparacion"><?= $strings['Reparadora'] ?></option>                        
                        </select>
                        <?php
                    }if ($loteria[2] == $strings['mantenimiento']) {
                        ?>
                        <option value="certificador"><?= $strings['Certificadora'] ?></option>
                        <option value="mantenimiento" selected><?= $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?= $strings['Reparadora'] ?></option>    
                        </select>
                        <?php
                    } else {
                        ?>
                        <option value="certificador"><?= $strings['Certificadora'] ?></option>
                        <option value="mantenimiento"><?= $strings['Mantenimiento'] ?></option>
                        <option value="reparacion" selected><?= $strings['Reparadora'] ?></option> 
                        </select>
                        <?php
                    }
                    ?>
                </div>                    
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Telefono']; ?>:</label>
                    <input type="text" value="<?php echo $empresas[3]; ?>" size="11" onblur="comprobarTelf(this);" id="telefonoempresa" name="telefono"  >
                </div>
                <div class="form-empresas">
                    <label><span>*</span><?php echo $strings['Localizacion']; ?>:</label>
                    <input type="text" value="<?php echo $empresas[4]; ?>" size="40" onblur="comprobarTexto(this, 50);" id="localizacionempresa" name="localizacion">
                </div>
                <button class="btn" name="action" value="EDIT" type="submit" class="boton-env">
                    <i class="fas fa-edit"></i>
                </button>
            </form>

        </section>
                                <!--<script src='../Views/js/LOTERIAIU_validaciones.js'></script>-->
        <?php
        include '../Views/Footer.php';
    }
}
?>
