<?php

class Usuario_SEARCH {

    function __construct() {
        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Buscar contratos']; ?></h2>        

        <section>
            <form class="form_edit" method="post" action="../Controllers/Usuarios_Controller.php" enctype="multipart/form-data">
                <fieldset id="fieldset_edit">

                    <label for="login"><?php echo $strings['Login'] ?>  *</label> 
                    <input name="login" type="text" size="25" id="login" onblur="comprobarTexto(this, 30);"/> 

                    <label for="DNI"><?php echo $strings['DNI'] ?>  *</label> 
                    <input name="DNI" type="text" size="25" id="DNI" onblur="comprobarTexto(this, 30);"/> 

                    <label for="nombre"><?php echo $strings['Nombre'] ?>  *</label> 
                    <input name="nombre" type="text" size="25" id="nombre" onblur="comprobarTexto(this, 30);"/> 
                    
                    <label for="apellidos"><?php echo $strings['Apellidos'] ?>  *</label> 
                    <input name="apellidos" type="text" size="25" id="apellidos" onblur="comprobarTexto(this, 30);"/> 
                    
                    <label for="telefono"><?php echo $strings['Telefono'] ?>  *</label> 
                    <input name="telefono" type="text" size="25" id="telefono" onblur="comprobarTexto(this, 30);"/> 
                    
                    <label for="email"><?php echo $strings['Email'] ?>  *</label> 
                    <input name="email" type="text" size="25" id="email" onblur="comprobarTexto(this, 30);"/> 
                    
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

