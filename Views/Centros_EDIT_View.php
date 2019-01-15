<?php

class Centros_EDIT_View {

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
                <form class="form_edit" method="post" action="../Controllers/Centros_Controller.php" onsubmit="return validacionSubmitEdit();">
                    <h2><?php echo $strings['Editar centro']; ?></h2>

                    <fieldset id="fieldset_edit">
                        <div class="form-group">
                            <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                            <input class="form-control" name="nombre" readonly type="text" size="25" readonly id="nombre" class="pk" value="<?php echo $datos['nombre'] ?>"  onblur="comprobarTexto(this, 10);"/> 
                        </div><div class="form-group">
                            <label for="lugar"><?php echo $strings['Lugar'] ?>  *</label> 
                            <input class="form-control" name="lugar" type="text" size="25" id="lugar" value="<?php echo $datos['lugar'] ?>"  onblur="comprobarTexto(this, 30);"/> 
                        </div><div class="form-group"><label for="usuarioAsignado"><?php echo $strings['Usuario asignado'] ?>  *</label> 
                            <input class="form-control" name="usuarioAsignado" type="text" size="25" id="usuarioAsignado" value="<?php echo $datos['usuarioAsignado'] ?>"  onblur="comprobarTexto(this, 9);"/> 
                        </div>
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

