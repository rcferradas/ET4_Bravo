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
                    <div class="form-group">
                        <label for="centro"><?php echo $strings['Centro'] ?>  *</label> 
                        <input class="form-control" name="centro" type="text" size="25" id="centro" onblur="comprobarTexto(this, 30);"/> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="tipo"><?php echo $strings['Tipo'] ?>  *</label>  
                        <select class="form-control" name="tipo" id="tipo">
                            <option value=""></option>
                            <option value="certificador"><?php echo $strings['Certificador'] ?></option>
                            <option value="mantenimiento"><?php echo $strings['Mantenimiento'] ?></option>
                            <option value="reparacion"><?php echo $strings['Reparacion'] ?></option>
                        </select>
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="cifEmpresa"><?php echo $strings['Empresa encargada'] ?>  *</label> 
                        <input class="form-control" name="cifEmpresa" type="text" id="cifEmpresa" /> <!--No se valida el resguardo en edit porque si no se introduce un fichero nuevo nos quedamos con el que ya esta almacenado-->
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="periodoinicio"><?php echo $strings['Periodo inicio']; ?>  *</label> 
                        <input class="form-control" type="date" name="periodoinicio" id="periodoinicio"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="periodofin"><?php echo $strings['Periodo fin']; ?>  *</label> 
                        <input class="form-control" type="date" name="periodofin" id="periodofin"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="frecuencia"><?php echo $strings['Frecuencia'] ?>  *</label> 
                        <input class="form-control" name="frecuencia" type="text" id="frecuenciaSC" /> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="importe"><?php echo $strings['Importe']; ?>  *</label> 
                        <input class="form-control" type="number" name="importe" id="importe" onblur="comprobarEntero(this, 1, 999);"> 
                    </div>&nbsp;&nbsp;<div class="form-group">
                        <label for="estado"><?php echo $strings['Estado']; ?>  *</label> 
                        <select class="form-control" id="estado" name="estado">
                            <option selected value=""></option>
                            <option value="norealizado"><?php echo $strings['No realizado'] ?></option>
                            <option value="realizado"><?php echo $strings['Realizado'] ?></option>
                            <option value="pagado"><?php echo $strings['Pagado'] ?></option>
                        </select>
                    </div>
                </fieldset>
                <span>* <?php echo $strings['Campos obligatorios']; ?> </span><br>
                <!-- Boton submit -->
                <button class="btn btn-outline-primary" name="action" type="submit" value="SEARCH"><i class="fas fa-check"></i></button>

            </form>
        </section>
        <?php
        include '../Views/Footer.php';
    }

}
?>

