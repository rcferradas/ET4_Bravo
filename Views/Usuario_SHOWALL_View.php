<?php

class Usuario_SHOWALL {

    function __construct($recordSet) {    //Constructor de la clase, pasamos un objeto tipo loteriaiu como parametro
        $this->render($recordSet);                  //------------------------REVISAR $recordSet----------------------------------------------------------
    }

    function render($recordSet) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }
        include '../Views/Header.php';
        //Mostrar tabla SHOWALL de Usuarios
        ?>
        <table class="table table-dark">
            <!--Comienzo encabezado tabla SHOWALL-->
            <thead>
                <tr>
                    <th scope="col"><?php echo $strings['Login']; ?></th>
                    <th scope="col"><?php echo $strings['Nombre']; ?></th>
                    <th scope="col"><?php echo $strings['Telefono']; ?></th>
                    <th scope="col"><form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Usuarios_Controller.php" method="">
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
                        <td><?php echo $tupla['login']; ?></td>
                        <td><?php echo $tupla['nombre']; ?></td>
                        <td><?php echo $tupla['telefono']; ?></td>
                        <td>
                            <!--Botones para realizar acciones en cada tupla-->
                            <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Usuarios_Controller.php" method="">
                                <input type="hidden" name=login value=<?php echo $tupla['login'] ?>>
                                <button name="action" value="SHOWCURRENT" type="submit" class="btn btn-outline-primary">
                                    <i class="far fa-eye"></i></button>&nbsp
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
    }

}
?>
