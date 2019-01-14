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
                <form class="form_edit" method="post" action="../Controllers/Contratos_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                    <h2><?php echo $strings['Editar contrato']; ?></h2>

                    <fieldset id="fieldset_edit">
                    <input hidden name="codcontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $datos['cod'] ?>"> 

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

                        <label for="cifEmpresa"><?php echo $strings['cifEmpresa']; ?>  *</label> 
                        <input name="cifEmpresa" type="text" id="cifEmpresa" value="<?php echo $datos['cifEmpresa']; ?>"/>

                        <label for="documento"><?php echo $strings['Documento']; ?>  *</label> 
                        <input type="file" name="documento" id="documento"> 

                        <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                        <input type="date" name="periodoinicio" id="periodoinicio" value="<?php echo $datos['periodoinicio']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                        <input type="date" name="periodofin" id="periodofin" value="<?php echo $datos['periodofin']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 

                        <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                        <input type="number" name="importe" id="importe" value="<?php echo $datos['importe']; ?>"  onblur="comprobarEntero(this, 1, 999);"> 
                        
                        <label for="frecuencia"><?php echo $strings['Frecuencia']; ?>  *</label> 
                        <input name="frecuencia" type="text" id="frecuencia" value="<?php echo $datos['frecuenciaVisitas']; ?>"/>
                        
                        <label for="estado"><?php echo $strings['Estado'] ?>  *</label>  
                        <select id="estado" name="estado">
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

