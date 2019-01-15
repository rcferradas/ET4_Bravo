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

                    <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                    <input name="centro" type="text" size="25" id="centro" onblur="comprobarTexto(this,30);"/> 

                    <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                    <select id="tipo" name="tipo">
                        <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                        <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                    </select>

                    <label for="cifEmpresa"><?php echo $strings['cifEmpresa']; ?>  *</label> 
                    <input type="text" name="cifEmpresa" id="cifEmpresa" onblur= "comprobarCIF( this );" > 

                    <label for="documento"><?php echo $strings['Documento']; ?>  *</label> 
                    <input name="documento" type="file" id="documento" onblur="comprobarVacio(this);"/>

                    <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                    <input type="date" name="periodoinicio" id="periodoinicio" onblur="comprobarVacio(this);"> 

                    <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                    <input type="date" name="periodofin" id="periodofin" onblur="comprobarVacio(this);"> 
                    
                    <label for="frecuencia"><?php echo $strings['Frecuencia']; ?>  *</label> 
                    <select  name="frecuencia" id="frecuencia"> 
                        <option  value="diaria"><?php echo $strings['Diaria'] ?></option>
                        <option value="semanal"><?php echo $strings['Semanal'] ?></option>
                        <option  value="mensual"><?php echo $strings['Mensual'] ?></option>
                        <option  value="trimestral"><?php echo $strings['Trimestral'] ?></option>
                        <option  value="anual" selected><?php echo $strings['Anual'] ?></option>
                        <option  value="quinquenal"><?php echo $strings['Quinquenal'] ?></option>
                    </select>
                     
                    <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                    <input type="number" name="importe" id="importe" onblur="comprobarReal(this, 2, 0, 999999999)"> 

                    <label for="estado"><?php echo $strings['Estado']; ?>  *</label> 
                    <select id="estado" name="estado">
                        <option selected value="norealizado"><?php echo $strings['No realizado'] ?></option>
                    </select>

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                <!-- Boton submit -->
                <button name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>

