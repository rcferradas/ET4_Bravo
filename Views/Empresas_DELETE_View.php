<?php
include_once '../Functions/Authentication.php';

class Empresas_DELETE_View {

    function __construct($tupla) {    //Constructor de la clase
        $this->render($tupla);
    }

    function render($tupla) {
        if (!isset($_SESSION['idioma'])) {   //Si no hay idioma seleccionado
            $_SESSION['idioma'] = 'ESPAÑOL'; //por defecto ponemos español
        }

        include '../Views/Header.php';
        ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col"><?php echo $strings['CIF']; ?></th>
                    <th scope="col"><?php echo $strings['Nombre']; ?></th>
                    <th scope="col"><?php echo $strings['Tipo']; ?></th>
                    <th scope="col"><?php echo $strings['Telefono']; ?></th>
                    <th scope="col"><?php echo $strings['Localizacion']; ?></th>
                    <th scope="col"><?php echo $strings['Confirmar borrado']; ?></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?php echo $tupla['CIF']; ?></td>
                    <td><?php echo $tupla['nombre']; ?></td>
                    <td><?php echo $tupla['tipo']; ?></td>
                    <td><?php echo $tupla['telefono']; ?></td>
                    <td><?php echo $tupla['localizacion']; ?></td>
                    <td>
                        <!--Botones para realizar acciones en cada tupla-->
                        <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Empresas_Controller.php" method="post">
                            <input type="hidden" name=cif value=<?php echo $tupla['CIF'] ?>>
                            <button name="action" value="DELETE" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }

}
?>


