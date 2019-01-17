<?php

class Contratos_EDIT_View {

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
                <form class="form_edit" method="post" action="../Controllers/Contratos_Controller.php" enctype="multipart/form-data" onsubmit="return validarContratosEDIT(this);">
                    <h2><?php echo $strings['Editar contrato']; ?></h2>

                    <fieldset id="fieldset_edit">
                        <input hidden name="codcontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $datos['cod'] ?>"> 
                        <div class="form-group">
                            <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                            <input readonly class="form-control" name="centro" type="text" size="25" id="centro" value="<?php echo $datos['centro'] ?>" /> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                            <select class="form-control" id="tipo" name="tipo">
                                <?php if ($datos['tipo'] == 'certificador') {
                                    ?>
                                    <option value="certificador" selected><?php echo $strings['Certificador'] ?></option>
                                    <option value="mantenimiento" ><?php echo $strings['Mantenimiento'] ?></option>
                                    <option value="reparacion" ><?php echo $strings['Reparacion'] ?></option>
                                    <?php
                                } elseif ($datos['tipo'] == 'mantenimiento') {
                                    ?>
                                    <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                                    <option value="mantenimiento" selected><?php echo $strings['Mantenimiento'] ?></option>
                                    <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                                    <?php
                                } elseif ($datos['tipo'] == 'reparacion') {
                                    ?>
                                    <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                                    <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                                    <option value="reparacion" selected><?php echo $strings['Reparacion'] ?></option>
                                <?php } else { ?>
                                    <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                                    <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                                    <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                                <?php } ?>
                            </select>
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="cifEmpresa"><?php echo $strings['cifEmpresa']; ?>  *</label> 
                            <input readonly class="form-control" name="cifEmpresa" type="text" id="cifEmpresa" value="<?php echo $datos['cifEmpresa']; ?>"/>
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="documento"><?php echo $strings['Documento']; ?>  *</label> <br>
                            <input type="file" name="documento" id="documento" > 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                            <input class="form-control" type="date" name="periodoinicio" id="periodoinicio" value="<?php echo $datos['periodoinicio']; ?>"  onblur="comprobarVacio(this);"> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                            <input class="form-control" type="date" name="periodofin" id="periodofin" value="<?php echo $datos['periodofin']; ?>"  onblur="comprobarVacio(this);"> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                            <input class="form-control" type="text" name="importe" id="importe" value="<?php echo $datos['importe']; ?>"  onblur="comprobarReal(this, 2, 0, 999999999)"> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="frecuencia"><?php echo $strings['Frecuencia']; ?>  *</label> 
                            <select  class="form-control" name="frecuencia" id="frecuencia"> 
                                <option  value="diaria"<?php
                                if ($datos['frecuenciaVisitas'] == 'diaria') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Diaria'] ?></option>
                                <option value="semanal"<?php
                                if ($datos['frecuenciaVisitas'] == 'semanal') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Semanal'] ?></option>
                                <option  value="mensual"<?php
                                if ($datos['frecuenciaVisitas'] == 'mensual') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Mensual'] ?></option>
                                <option  value="trimestral"<?php
                                if ($datos['frecuenciaVisitas'] == 'trimestral') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Trimestral'] ?></option>
                                <option  value="anual" <?php
                                if ($datos['frecuenciaVisitas'] == 'anual') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Anual'] ?></option>
                                <option  value="quinquenal"<?php
                                if ($datos['frecuenciaVisitas'] == 'quinquenal') {
                                    echo 'selected';
                                }
                                ?>><?php echo $strings['Quinquenal'] ?></option>
                            </select>
                        </div>&nbsp;&nbsp;<div class="form-group"><label for="estado"><?php echo $strings['Estado'] ?>  *</label>  
                            <select class="form-control" id="estado" name="estado">
                                <?php if ($datos['estado'] == 'realizado') {
                                    ?>
                                    <option value="realizado" selected><?php echo $strings['Realizado'] ?></option>
                                    <option value="norealizado" ><?php echo $strings['No realizado'] ?></option>
                                    <option value="pagado" ><?php echo $strings['Pagado'] ?></option>
                                    <?php
                                } elseif ($datos['estado'] == 'norealizado') {
                                    ?>
                                    <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                                    <option value="norealizado" selected><?php echo $strings['No realizado'] ?></option>
                                    <option value="pagado"><?php echo $strings['Pagado'] ?></option>
                                    <?php
                                } elseif ($datos['estado'] == 'pagado') {
                                    ?>
                                    <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                                    <option value="norealizado"><?php echo $strings['No realizado'] ?></option>
                                    <option value="pagado" selected><?php echo $strings['Pagado'] ?></option>
                                <?php } ?>
                            </select></div>
                    </fieldset>
                    <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                    <!-- Boton submit -->
                    <button class="btn btn-outline-primary" name="action" type="submit" value="EDIT"><i class="fas fa-check"></i></button>
                </form>
            </section>

            <?php include '../Views/Footer.php'; ?>

            <?php
        }

    }
    ?>

