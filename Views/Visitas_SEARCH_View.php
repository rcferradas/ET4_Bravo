<?php

class visitas_SEARCH_View {

    function __construct() {
        $this->render();
    }

    function render() {
        if (!isset($_SESSION['idioma'])) {
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Views/Header.php';
        ?>
        <h2><?php echo $strings['Buscar visitas']; ?></h2>        

             <table class="table table-dark table-striped">
            <!--Comienzo encabezado tabla SEARCH-->
            <thead>
                <tr>
                    <th scope="col"><?php echo $strings['Fecha']; ?></th>
                    <th scope="col"><?php echo $strings['Tipo']; ?></th>
                    <th scope="col"><?php echo $strings['Estado']; ?></th>
                    <th scope="col"><form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Visitas_Controller.php" method="">
                             <input type="hidden" name=codcontrato value=<?php echo $_REQUEST['codcontrato']?>>
                            <button name="action" value="ADD" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i></button>&nbsp
                            <button name="action" value="SEARCH" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i></button>&nbsp
                        </form>
                    </th>
                </tr>
            </thead>
            <!--Fin encabezado tabla SHOWALL-->

            <tbody>
                <?php
                //Bucle que recorre todas las tuplas y va mostrando sus atributos
                while ($tupla = $recordSet->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $tupla['fecha']; ?></td>
                        <td><?php echo $tupla['tipo']; ?></td>
                        <td><?php echo $tupla['estado']; ?></td>
                        <td>
                            <!--Botones para realizar acciones en cada tupla-->
                            <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Visitas_Controller.php" method="">
                                <input type="hidden" name=codvisita value=<?php echo $tupla['codVisita'] ?>>
                                <input type="hidden" name=codcontrato value=<?php echo $tupla['codContrato'] ?>>
                                <button name="action" value="SHOWCURRENT" type="submit" class="btn btn-outline-primary">
                                    <i class="far fa-eye"></i></button>&nbsp
                                <button name="action" value="EDIT" type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i></button>&nbsp
                                     <?php 
                                     if($tupla['estado']== 'incidencia'){
                                     echo '<button name="action" value="INCIDENCIA" type="submit" class="btn btn-outline-primary">';
                                     echo '<i class="fas fa-plus"></i></button>&nbsp';
                                     }
                                             ?>
                                
                                <button name="action" value="DELETE" type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        include '../Views/Footer.php';
    }

}
?>

