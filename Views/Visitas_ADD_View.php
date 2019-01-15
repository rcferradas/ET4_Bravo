<?php

class Visitas_ADD_View {

    function __construct($codigoContrato) {

        $this->render($codigoContrato);
    }

    function render($codigoContrato) {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Añadir Visita']; ?></h2>        
        <section>
            <form class="form_add" method="post" action="../Controllers/Visitas_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                <fieldset id="fieldset_add">
                    <input type="hidden" name=codcontrato value=<?php echo $codigoContrato; ?>>
                     <label for="estado"><?php echo $strings['Estado'] ?>  *</label>  
                    <select id="estadoAdd1" name="estado">
                        <option value="realizada"><?php echo $strings['Realizada'] ?></option>
                        <option value="pendiente"><?php echo $strings['Pendiente'] ?></option>
                        <option value="incidencia"><?php echo $strings['Incidencia'] ?></option>
                        <option value=""></option>
                    </select>
                    <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                    <select id="tipo" name="tipo">
                        <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                        <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                    </select>

                    <label for="informe"><?php echo $strings['Informe']; ?>  *</label> 
                    <input name="informe" type="file" id="informeAdd1" />

                    <label for="fecha"><?php echo $strings['Fecha']; ?>  *</label> 
                    <input type="date" name="fecha" id="fechaAdd1"> 
                    

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

