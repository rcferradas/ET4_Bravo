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

                    <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                    <input name="login" type="text" size="25" id="login"/> 

                    <label for="DNI"><?php echo $strings['DNI'] ?>  *</label> 
                    <input name="DNI" type="text" size="25" id="DNI"/> 

                    <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                    <input name="nombre" type="text" size="25" id="nombre"/> 
                    
                    <label for="apellidos"><?php echo $strings['Apellidos'] ?>  *</label> 
                    <input name="apellidos" type="text" size="25" id="apellidos"/> 
                    
                    <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                    <input name="telefono" type="text" size="25" id="telefono"/> 
                    
                    <label for="email"><?php echo $strings['Email'] ?>  *</label> 
                    <input name="email" type="text" size="25" id="email"/> 
                    
                    <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                    <select name="rol" id="rol">
                        <option value=""></option>
                        <option value="admin"><?php echo $strings['Admin'] ?></option>
                        <option value="centro"><?php echo $strings['Centro'] ?></option>
                    </select>

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                <!-- Boton submit -->
                <button name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

