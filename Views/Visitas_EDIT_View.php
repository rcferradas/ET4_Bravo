<?php

class Visitas_EDIT_View {

    function __construct($datos) {    //Constructor de la clase, pasamos un objeto tipo loteriaiu como parametro
        $this->render($datos);
    }

    function render($datos) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }
        include '../Views/Header.php';
        ?>
        <html>

            <section>
                <form class="form_edit" method="post" action="../Controllers/Visitas_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                    <h2><?php echo $strings['Editar visita']; ?></h2>

                    <fieldset id="fieldset_edit">
                    <input hidden name="codcontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $datos['codContrato'] ?>"> 
                    <input hidden name="codvisita" type="text" size="25" id="codvisitaEd" value="<?php echo $datos['codVisita'] ?>"> 
                    
                        <label for="estado"><?php echo $strings['Estado'] ?>  *</label> 
                        <select id="estado" name="estado">
   
                              <option value="realizada"  <?php if ($datos['estado'] == 'realizada') {echo 'selected';}?>><?php echo $strings['Realizada'] ?></option>
                              <option value="pendiente"<?php if ($datos['estado'] == 'pendiente') {echo 'selected';}?> ><?php echo $strings['Pendiente'] ?></option>
                              <option value="incidencia" <?php if ($datos['estado'] == 'incidencia') {echo 'selected';}?>><?php echo $strings['Incidencia'] ?></option>
                              <option value="" <?php if ($datos['estado'] == '') {echo 'selected';}?>></option>
                        </select>
                        <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                        <select id="tipo" name="tipo">
   
                              <option value="certificador"  <?php if ($datos['tipo'] == 'certificador') {echo 'selected';}?>><?php echo $strings['Certificador'] ?></option>
                              <option value="mantenimiento"<?php if ($datos['tipo'] == 'mantenimiento') {echo 'selected';}?> ><?php echo $strings['Mantenimiento'] ?></option>
                              <option value="reparacion" <?php if ($datos['tipo'] == 'reparacion') {echo 'selected';}?>><?php echo $strings['Reparacion'] ?></option>
                              <option value="" <?php if ($datos['tipo'] == '') {echo 'selected';}?>></option>
                        </select>

                        <label for="informe"><?php echo $strings['Informe']; ?>  *</label> 
                        <input type="file" name="informe" id="informe"> 

                        <label for="fecha"><?php echo $strings['Fecha']; ?>  *</label> 
                        <input type="date" name="fecha" id="fecha" value="<?php echo $datos['fecha']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                     
                    </fieldset>
                    <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                    <!-- Boton submit -->
                    <button name="action" type="submit" value="EDIT"><i class="fas fa-check"></i></button>
                </form>
            </section>

            <?php include '../Views/Footer.php'; ?>

            <?php
        }

    }
    ?>

