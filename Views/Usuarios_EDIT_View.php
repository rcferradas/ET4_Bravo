<!--17-01-2019/Bravo/Vista que nos permite editar un usuario -->

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
                <form class="form_edit" method="post" action="../Controllers/Usuarios_Controller.php" onsubmit="return validarUsuariosEDIT(this);">
                    <h2><?php echo $strings['Editar usuario']; ?></h2>

                    <fieldset id="fieldset_edit">
                        <div class="form-group">
                            <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                            <input class="form-control" name="login" type="text" size="25" readonly id="login" class="pk" value="<?php echo $datos['login'] ?>"  /> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="password"><?php echo $strings['Password'] ?>  *</label> 
                            <input class="form-control" name="password" type="text" size="25" id="password" value="<?php echo $datos['password'] ?>"  onblur="comprobarAlfabetico(this, 25);"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="DNI"><?php echo $strings['DNI'] ?>  *</label> 
                            <input class="form-control" name="DNI" type="text" size="25" id="DNI" value="<?php echo $datos['DNI'] ?>"  onblur="comprobarDni(this)"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                            <input class="form-control" name="nombre" type="text" size="25" id="nombre" value="<?php echo $datos['nombre'] ?>"  onblur="comprobarTexto(this, 30);"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="apellidos"><?php echo $strings['Apellidos'] ?>  *</label> 
                            <input class="form-control" name="apellidos" type="text" size="25" id="apellidos" value="<?php echo $datos['apellidos'] ?>"  onblur="comprobarTexto(this, 50);"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                            <input class="form-control" name="telefono" type="text" size="25" id="telefono" value="<?php echo $datos['telefono'] ?>"  onblur="comprobarTelf(this);"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="email"><?php echo $strings['Email'] ?>  *</label> 
                            <input class="form-control" name="email" type="text" size="25" id="email" value="<?php echo $datos['email'] ?>"  onblur="comprobarExpresionRegular(this, /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/, 60);"/> 
                        </div>&nbsp;&nbsp;<div class="form-group">
                            <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                            <select class="form-control" id="rol" name="rol">
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

