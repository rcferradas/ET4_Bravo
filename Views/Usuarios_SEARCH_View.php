<?php

class Usuarios_SEARCH_View {

    function __construct() {
        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Buscar usuarios']; ?></h2>        

        <section>
            <form class="form_search" method="post" action="../Controllers/Usuarios_Controller.php" onsubmit="return validarSearchUsuarios(this);">
                <fieldset id="fieldset_search">
                    <div class="form-group">
                        <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                        <input class="form-control" name="login" type="text" size="25" id="login"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="DNI"><?php echo $strings['DNI'] ?>  *</label> 
                        <input class="form-control" name="DNI" type="text" size="25" id="DNI"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                        <input class="form-control" name="nombre" type="text" size="25" id="nombre"/> 
                    </div>&nbsp;&nbsp;<div class="form-group"> 
                        <label for="apellidos"><?php echo $strings['Apellidos'] ?>  *</label> 
                        <input class="form-control" name="apellidos" type="text" size="25" id="apellidos"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                        <input class="form-control" name="telefono" type="text" size="25" id="telefono"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="email"><?php echo $strings['Email'] ?>  *</label> 
                        <input class="form-control" name="email" type="text" size="25" id="email"/> 
                    </div>&nbsp;&nbsp;<div class="form-group"> 
                        <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                        <select class="form-control" name="rol" id="rol">
                            <option value=""></option>
                            <option value="admin"><?php echo $strings['Admin'] ?></option>
                            <option value="centro"><?php echo $strings['Centro'] ?></option>
                        </select></div>

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <button name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

