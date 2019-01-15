<?php

class Contratos_ADD_View {

    function __construct() {

        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Añadir contrato']; ?></h2>        

        <section>
            <form class="form_add" method="post" action="../Controllers/Contratos_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                <fieldset id="fieldset_add">
                    <input hidden name="cod" type="text" size="25" id="cod" value="NULL"> 
                    <div class="form-group">
                        <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                        <input class="form-control" name="centro" type="text" size="25" id="centro" onblur="comprobarTexto(this, 30);"/> 
                    </div><div class="form-group">
                        <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                        <select class="form-control" id="tipo" name="tipo">
                            <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                            <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                            <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                        </select>
                    </div><div class="form-group">
                        <label for="cifEmpresa"><?php echo $strings['cifEmpresa']; ?>  *</label> 
                        <input class="form-control" type="text" name="cifEmpresa" id="cifEmpresa" onblur= "comprobarCIF(this);" > 
                    </div><div class="form-group">
                        <label for="documento"><?php echo $strings['Documento']; ?>  *</label> <br>
                        <input name="documento" type="file" id="documento" onblur="comprobarVacio(this);"/>
                    </div><div class="form-group">
                        <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                        <input class="form-control" type="date" name="periodoinicio" id="periodoinicio" onblur="comprobarVacio(this);"> 
                    </div><div class="form-group">
                        <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                        <input class="form-control" type="date" name="periodofin" id="periodofin" onblur="comprobarVacio(this);"> 
                    </div><div class="form-group">    
                        <label for="frecuencia"><?php echo $strings['Frecuencia']; ?>  *</label> 
                        <select  class="form-control" name="frecuencia" id="frecuencia"> 
                            <option  value="diaria"><?php echo $strings['Diaria'] ?></option>
                            <option value="semanal"><?php echo $strings['Semanal'] ?></option>
                            <option  value="mensual"><?php echo $strings['Mensual'] ?></option>
                            <option  value="trimestral"><?php echo $strings['Trimestral'] ?></option>
                            <option  value="anual" selected><?php echo $strings['Anual'] ?></option>
                            <option  value="quinquenal"><?php echo $strings['Quinquenal'] ?></option>
                        </select>
                    </div><div class="form-group"> 
                        <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                        <input class="form-control" type="number" name="importe" id="importe" onblur="comprobarReal(this, 2, 0, 999999999)"> 
                    </div><div class="form-group">
                        <label for="estado"><?php echo $strings['Estado']; ?>  *</label> 
                        <select class="form-control" id="estado" name="estado">
                            <option selected value="norealizado"><?php echo $strings['No realizado'] ?></option>
                        </select>
                    </div>
                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <!-- Boton submit -->
                <button class="btn btn-outline-primary" name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>

