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
                        <div class="form-group">
                            <label for="estado"><?php echo $strings['Estado'] ?>  *</label> 
                            <select class="form-control" id="estado" name="estado">

                                <option value="realizada"  <?php
                                if ($datos['estado'] == 'realizada') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Realizada'] ?></option>
                                <option value="pendiente"<?php
                                if ($datos['estado'] == 'pendiente') {
                                    echo 'selected';
                                }
                                ?> ><?php echo $strings['Pendiente'] ?></option>
                                <option value="incidencia" <?php
                                if ($datos['estado'] == 'incidencia') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Incidencia'] ?></option>
                            </select>
                        </div>&nbsp;&nbsp;<div class="form-group"><label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="certificador"  <?php
                                if ($datos['tipo'] == 'certificador') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Certificador'] ?></option>
                                <option value="mantenimiento"<?php
                                if ($datos['tipo'] == 'mantenimiento') {
                                    echo 'selected';
                                }
                                ?> ><?php echo $strings['Mantenimiento'] ?></option>
                                <option value="reparacion" <?php
                                if ($datos['tipo'] == 'reparacion') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Reparacion'] ?></option>
                          
                            </select>
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="informe"><?php echo $strings['Informe']; ?>  *</label> <br>
                            <input type="file" name="informe" id="informe"> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="fecha"><?php echo $strings['Fecha']; ?>  *</label> 
                            <input class="form-control" type="date" name="fecha" id="fecha" value="<?php echo $datos['fecha']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 
                        </div>
                    </fieldset>
                    <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                    <!-- Boton submit -->
                    <button name="action" type="submit" value="EDIT"><i class="fas fa-check"></i></button>
                </form>
            </section>

            <?php include '../Views/Footer.php'; ?>

            <?php
        }

    }
    ?>

