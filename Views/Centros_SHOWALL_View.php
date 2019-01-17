<?php

class Centros_SHOWALL_View {

    function __construct($recordSet) {    //Constructor de la clase, pasamos un objeto tipo loteriaiu como parametro
        $this->render($recordSet);                  //------------------------REVISAR $recordSet----------------------------------------------------------
    }

    function render($recordSet) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }
        include '../Views/Header.php';
        //Mostrar tabla SHOWALL de Centros
        ?>
        <table class="table table-dark table-striped">
            <!--Comienzo encabezado tabla SHOWALL-->
            <thead>
                <tr>
                    <th scope="col"><?php echo $strings['Nombre']; ?></th>
                    <th scope="col"><?php echo $strings['Lugar']; ?></th>
                    <th scope="col"><?php echo $strings['Usuario asignado']; ?></th>
                    <th scope="col"><form class="form-inline my-2 my-lg-0" name='form_showall' action="../Controllers/Centros_Controller.php" method="">
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
                        <td><?php echo $tupla['nombre']; ?></td>
                        <td><?php echo $tupla['lugar']; ?></td>
                        <td><?php echo $tupla['usuarioAsignado']; ?></td>
                        <td>
                            <!--Botones para realizar acciones en cada tupla-->
                            <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Centros_Controller.php" method="">
                                <input type="hidden" name=nombre value=<?php echo $tupla['nombre'] ?>>
                                <button name="action" value="EDIT" type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i></button>&nbsp
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
