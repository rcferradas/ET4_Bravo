<!--17-01-2019/Bravo/Vista que nos muestra todos los contratos -->

<?php

class Contratos_SHOWALL_View {

    function __construct($recordSet) {    //Constructor de la clase, pasamos un objeto tipo loteriaiu como parametro
        $this->render($recordSet);                  //------------------------REVISAR $recordSet----------------------------------------------------------
    }

    function render($recordSet) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }
        include '../Views/Header.php';
        //Mostrar tabla SHOWALL de Contratos
        ?>
        <table class="table table-striped table-dark">
            <!--Comienzo encabezado tabla SHOWALL-->
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?php echo $strings['Centro']; ?></th>
                    <th scope="col"><?php echo $strings['Tipo']; ?></th>
                    <th scope="col"><?php echo $strings['Empresa encargada']; ?></th>
                    <th scope="col"><?php echo $strings['Estado']; ?></th>
                    <th scope="col"><form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Contratos_Controller.php" method="">
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
                        <td><?php echo $tupla['centro']; ?></td>
                        <td><?php echo $tupla['tipo']; ?></td>
                        <td><?php echo $tupla['cifEmpresa']; ?></td>
                        <td><?php echo $tupla['estado']; ?></td>
                        <td>
                            <!--Botones para realizar acciones en cada tupla-->
                            <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Contratos_Controller.php" method="">
                                <input type="hidden" name=codcontrato value=<?php echo $tupla['cod'] ?>>
                                <button name="action" value="SHOWCURRENT" type="submit" class="btn btn-outline-primary">
                                    <i class="far fa-eye"></i></button>&nbsp
                                <button name="action" value="EDIT" type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i></button>&nbsp
                                <button name="action" value="DELETE" type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-trash-alt"></i></button>&nbsp
                                <button name="action" value="VISITAS" type="submit" class="btn btn-outline-primary">
                                    <i class="fa fa-list"></i></button>
                                    <?php if ($tupla['estado'] != 'pagado') {
                                        echo '<button name="action" value="PAGAR" type="submit" class="btn btn-outline-primary">
                                   <i class="fa fa-university"></i></button>';
                                    } ?>
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
