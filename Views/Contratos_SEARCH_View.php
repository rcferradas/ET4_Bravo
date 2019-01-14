<?php

class Contratos_SEARCH_View {

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
            <form class="form_search" method="post" action="../Controllers/Contratos_Controller.php">
                <fieldset id="fieldset_search">
                   
                    <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                    <input name="centro" type="text" size="25" id="centro" onblur="comprobarTexto(this, 30);"/> 

                    <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                    <select name="tipo" id="tipo">
                        <option value=""></option>
                        <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                        <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                        <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                    </select>

                    <label for="cifEmpresa"><?php echo $strings['Empresa encargada'] ?>  *</label> 
                    <input name="cifEmpresa" type="text" id="cifEmpresa" /> <!--No se valida el resguardo en edit porque si no se introduce un fichero nuevo nos quedamos con el que ya esta almacenado-->

                    <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                    <input type="date" name="periodoinicio" id="periodoinicio"> 

                    <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                    <input type="date" name="periodofin" id="periodofin"> 
                    
                    
                    <label for="frecuencia"><?php echo $strings['Frecuencia'] ?>  *</label> 
                    <input name="frecuencia" type="text" id="frecuenciaSC" /> 

                    <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                    <input type="number" name="importe" id="importe" onblur="comprobarEntero(this, 1, 999);"> 

                    <label for="estado"><?php echo $strings['Estado']; ?>  *</label> 
                    <select id="estado" name="estado">
                        <option selected value=""></option>
                        <option value="norealizado"><?php echo $strings['No realizado'] ?></option>
                        <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                        <option value="pagado"><?php echo $strings['Pagado'] ?></option>
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

