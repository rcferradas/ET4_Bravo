<!--17-01-2019/Bravo/Vista que nos permite buscar una o más visitas relacionadas a un contrato -->

<?php

class Visitas_SEARCH_View {

   function __construct($datos,$codcon) {    //Constructor de la clase, pasamos un objeto tipo loteriaiu como parametro
        $this->render($datos,$codcon);
    }

    function render($datos,$codcon) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }
        include '../Views/Header.php';
        ?>
        <html>

            <section>
                <form class="form_edit" method="post" action="../Controllers/Visitas_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                    <h2><?php echo $strings['Buscar visitas']; ?></h2>

                    <fieldset id="fieldset_edit">
                        <input hidden name="codcontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $codcon?>">
                        <input hidden name="fechaicontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $datos[0]?>"> 
                        <input hidden name="fechafcontrato" type="text" size="25" id="codcontratoEd" value="<?php echo $datos[1]?>"> 
                        <div class="form-group">
                            <label for="estado"><?php echo $strings['Estado'] ?>  </label> 
                            <select class="form-control" id="estado" name="estado">

                                <option value="realizada"><?php echo $strings['Realizada'] ?></option>
                                <option value="pendiente"><?php echo $strings['Pendiente'] ?></option>
                                <option value="incidencia"><?php echo $strings['Incidencia'] ?></option>
                                <option value="" selected></option>  
                            </select>
                        </div>&nbsp;&nbsp;
                        <div class="form-group">
                            <label for="tipo"><?php echo $strings['Tipo'] ?>  </label>  
                       
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="certificador" ><?php echo $strings['Certificador'] ?></option>
                                <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                                <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                                <option value="" selected ></option>
                            </select>
                        </div>&nbsp;&nbsp;
                        <div class="form-group">
                            <label for="fecha"><?php echo $strings['Fecha de comienzo']; ?>  </label> 
                            <input readonly type="text" class="tcal" name="fechainicio" id="fecha"   onblur="comprobarEntero(this, 1, 999);"> 
                        </div>
                        <div class="form-group">
                            <label for="fecha"><?php echo $strings['Fecha de fin']; ?>  </label> 
                            <input readonly type="text" class="tcal" name="fechafin" id="fecha"  >
                        </div>
                         <div class="form-group">
                            <label for="padre"><?php echo $strings['Reparadoras de incidencias']; ?>  </label> 
                            <select class="form-control" id="padre" name="padre"> 
                                <option value="buscar" ><?php echo $strings['Buscar'] ?></option>
                                <option value="" selected></option>
                            </select>
                         </div>
                    </fieldset>
                    <span>* <?php echo $strings['Seleccionar al menos un campo']; ?> </span><br>
                    <!-- Boton submit -->
                    <button name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>
                </form>
            </section>

            <?php include '../Views/Footer.php'; ?>

            <?php
        }

    }
    ?>

