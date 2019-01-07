<?php

class Contratos_EDIT {

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
                <form class="form_edit" method="post" action="../Controllers/Contratos_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                    <h2>EDITAR CONTRATO</h2>

                    <fieldset id="fieldset_edit">
                        <input name="cod" type ="hidden" value=<?php echo $datos['cod']; ?> />

                        <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                        <input name="centro" type="text" size="25" id="centro" value="<?php echo $datos['centro'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                        <select id="tipo" name="tipo">
                            <?php if ($datos['tipo'] == 'certificador') {
                                ?>
                                <option value="certificador" selected><?php echo $strings['Certificador'] ?></option>
                                <option value="mantenimiento" ><?php echo $strings['Mantenimiento'] ?></option>
                                <option value="reparacion" ><?php echo $strings['Reparacion'] ?></option>
                                <?php
                            }
                            if ($datos['tipo'] == 'mantenimiento') {
                                ?>
                                <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                                <option value="mantenimiento" selected><?php echo $strings['Mantenimiento'] ?></option>
                                <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                                <?php
                            }
                            if ($datos['tipo'] == 'reparacion') {
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

                        <label for="cifEmpresa"><?php echo $strings['cifEmpresa']; ?>  *</label> 
                        <input name="cifEmpresa" type="text" id="cifEmpresa" /> <!--No se valida el resguardo en edit porque si no se introduce un fichero nuevo nos quedamos con el que ya esta almacenado-->

                        <label for="documento"><?php echo $strings['Documento']; ?>  *</label> 
                        <input type="number" name="documento" id="documento" value="<?php echo $datos['documento']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                        <input type="number" name="periodoinicio" id="periodoinicio" value="<?php echo $datos['periodoInicio']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                        <input type="number" name="periodofin" id="periodofin" value="<?php echo $datos['periodoFin']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                        <input type="number" name="importe" id="importe" value="<?php echo $datos['importe']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="estado"><?php echo $strings['Estado'] ?>  *</label>  
                        <select id="estado" name="estado">
                            <?php if ($datos['estado'] == 'realizado') {
                                ?>
                                <option value="realizado" selected><?php echo $strings['Realizado'] ?></option>
                                <option value="norealizado" ><?php echo $strings['norealizado'] ?></option>
                                <option value="pagado" ><?php echo $strings['Pagado'] ?></option>
                                <?php
                            }
                            if ($datos['estado'] == 'norealizado') {
                                ?>
                                <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                                <option value="norealizado" selected><?php echo $strings['No realizado'] ?></option>
                                <option value="pagado"><?php echo $strings['Pagado'] ?></option>
                                <?php
                            }
                            if ($datos['estado'] == 'pagado') {
                                ?>
                                <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                                <option value="norealizado"><?php echo $strings['No realizado'] ?></option>
                                <option value="pagado" selected><?php echo $strings['Pagado'] ?></option>
                            <?php } ?>
                        </select>
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

