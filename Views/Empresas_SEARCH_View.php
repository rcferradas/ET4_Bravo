<!--17-01-2019/Bravo/Vista que nos permite buscar una o más empresas -->

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
            <form class="form_edit" method="post" action="../Controllers/Empresas_Controller.php" enctype="multipart/form-data" onsubmit="return validarSearchEmpresas(this);">
                <fieldset id="fieldset_edit">
                    <div class="form-group">
                        <label for="cif"><?php echo $strings['CIF'] ?>  *</label> 
                        <input class="form-control" name="cif" type="text" size="25" id="cif"/> 
                    </div>&nbsp;&nbsp;<div class="form-group"> <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                        <input class="form-control" name="nombre" type="text" size="25" id="nombre"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                        <select class="form-control" name="tipo" id="tipo">
                            <option value=""></option>
                            <option value="certificador"><?php echo $strings['Certificadora'] ?></option>
                            <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                            <option value="reparacion"><?php echo $strings['Reparadora'] ?></option>
                        </select>
                    </div>&nbsp;&nbsp;<div class="form-group"><label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                        <input class="form-control" name="telefono" type="text" size="25" id="telefono"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="localizacion"><?php echo $strings['Localizacion'] ?>  *</label> 
                        <input class="form-control" name="localizacion" type="text" size="25" id="localizacion"/> 
                    </div>
                </fieldset>
                <!-- Boton submit -->
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <button class="btn btn-outline-primary" name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>


            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>

