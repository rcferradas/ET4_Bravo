<?php

class Usuarios_ADD_View {

    function __construct() {

        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Añadir usuario']; ?></h2>        

        <section>
            <form class="form_add" method="post" action="../Controllers/Usuarios_Controller.php" onsubmit="return validarUsuariosADD(this);">
                <fieldset id="fieldset_add">
                    <div class="form-group">
                        <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                        <input class="form-control" name="login" type="text" size="25" id="login" onblur="comprobarAlfabetico(this, 15);"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="password"><?php echo $strings['Password'] ?>  *</label> 
                        <input class="form-control" name="password" type="text" size="25" id="password" onblur="comprobarAlfabetico(this, 25);"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="DNI"><?php echo $strings['DNI']; ?>  *</label> 
                        <input class="form-control" type="text" name="DNI" id="DNI" onblur="comprobarDni(this)" > 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="nombre"><?php echo $strings['Nombre']; ?>  *</label> 
                        <input class="form-control" type="text" name="nombre" id="nombre" onblur="comprobarTexto(this, 30);"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="apellidos"><?php echo $strings['Apellidos']; ?>  *</label> 
                        <input class="form-control" type="text" name="apellidos" id="apellidos" onblur="comprobarTexto(this, 50);"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="telefono"><?php echo $strings['Telefono']; ?>  *</label> 
                        <input class="form-control" type="text" name="telefono" id="telefono" onblur="comprobarTelf(this);"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="email"><?php echo $strings['Email']; ?>  *</label> 
                        <input class="form-control" type="text" name="email" id="email" onblur="comprobarExpresionRegular(this, /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/, 60);"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                        <select class="form-control" id="rol" name="rol">
                            <option value="admin"><?php echo $strings['Admin'] ?></option>
                            <option value="centro"><?php echo $strings['Centro'] ?></option>
                        </select></div>

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <!-- Boton submit -->
                <button name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <script src='../Views/js/validaciones.js'></script>
        <?php
        include '../Views/Footer.php';
    }

}
?>

