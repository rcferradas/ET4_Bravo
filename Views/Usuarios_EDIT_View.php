<?php

class Usuarios_EDIT_View {

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
                <form class="form_edit" method="post" action="../Controllers/Usuarios_Controller.php" onsubmit="return validacionSubmitEdit();">
                    <h2><?php echo $strings['Editar usuario']; ?></h2>

                    <fieldset id="fieldset_edit">

                        <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                        <input name="login" type="text" size="25" readonly id="login" value="<?php echo $datos['login'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="password"><?php echo $strings['Password'] ?>  *</label> 
                        <input name="password" type="text" size="25" id="password" value="<?php echo $datos['password'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="DNI"><?php echo $strings['DNI'] ?>  *</label> 
                        <input name="DNI" type="text" size="25" id="DNI" value="<?php echo $datos['DNI'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                        <input name="nombre" type="text" size="25" id="nombre" value="<?php echo $datos['nombre'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="apellidos"><?php echo $strings['Apellidos'] ?>  *</label> 
                        <input name="apellidos" type="text" size="25" id="apellidos" value="<?php echo $datos['apellidos'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                        <input name="telefono" type="text" size="25" id="telefono" value="<?php echo $datos['telefono'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="email"><?php echo $strings['Email'] ?>  *</label> 
                        <input name="email" type="text" size="25" id="email" value="<?php echo $datos['email'] ?>"  onblur="comprobarTexto(this, 30);"/> 

                        <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                        <select id="rol" name="rol">
                            <?php if ($datos['rol'] == 'admin') {
                                ?>
                                <option value="admin" selected><?php echo $strings['Admin'] ?></option>
                                <option value="centro" ><?php echo $strings['Centro'] ?></option>
                                <?php
                            } elseif ($datos['rol'] == 'centro') {
                                ?>
                                <option value="centro" selected><?php echo $strings['Centro'] ?></option>
                                <option value="admin"><?php echo $strings['Admin'] ?></option>
                                <?php
                            }
                            ?>
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

