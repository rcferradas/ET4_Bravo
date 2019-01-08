<?php

class Usuarios_ADD {

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
            <form class="form_add" method="post" action="../Controllers/Usuarios_Controller.php" enctype="multipart/form-data" onsubmit="return validacionSubmitEdit();">
                <fieldset id="fieldset_add">

                    <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                    <input name="login" type="text" size="25" id="login" onblur="comprobarTexto(this, 30);"/> 

                    <label for="password"><?php echo $strings['Password'] ?>  *</label> 
                    <input name="password" type="text" size="25" id="password" onblur="comprobarTexto(this, 30);"/> 

                    <label for="DNI"><?php echo $strings['DNI']; ?>  *</label> 
                    <input type="text" name="DNI" id="DNI"> 

                    <label for="nombre"><?php echo $strings['Nombre']; ?>  *</label> 
                    <input type="text" name="nombre" id="nombre"> 

                    <label for="apellidos"><?php echo $strings['Apellidos']; ?>  *</label> 
                    <input type="text" name="apellidos" id="apellidos"> 

                    <label for="telefono"><?php echo $strings['Telefono']; ?>  *</label> 
                    <input type="text" name="telefono" id="telefono"> 

                    <label for="email"><?php echo $strings['Email']; ?>  *</label> 
                    <input type="text" name="email" id="email"> 

                    <label for="rol"><?php echo $strings['Rol'] ?>  *</label>  
                    <select id="rol" name="rol">
                        <option value="admin"><?php echo $strings['Admin'] ?></option>
                        <option value="centro"><?php echo $strings['Centro'] ?></option>
                    </select>

                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span>
                <!-- Boton submit -->
                <button name="action" type="submit" value="ADD"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

