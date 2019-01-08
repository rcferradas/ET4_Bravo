<?php
include_once '../Functions/Authentication.php';

class Usuario_SHOWCURRENT {

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
                    <th scope="col"><?php echo $strings['Login']; ?></th>
                    <th scope="col"><?php echo $strings['DNI']; ?></th>
                    <th scope="col"><?php echo $strings['Nombre']; ?></th>
                    <th scope="col"><?php echo $strings['Apellidos']; ?></th>
                    <th scope="col"><?php echo $strings['Telefono']; ?></th>
                    <th scope="col"><?php echo $strings['Email']; ?></th>
                    <th scope="col"><?php echo $strings['Rol']; ?></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?php echo $tupla['login']; ?></td>
                    <td><?php echo $tupla['DNI']; ?></td>
                    <td><?php echo $tupla['nombre']; ?></td>
                    <td><?php echo $tupla['apellidos']; ?></td>
                    <td><?php echo $tupla['telefono']; ?></td>
                    <td><?php echo $tupla['email']; ?></td>
                    <td><?php echo $tupla['rol']; ?></td>
                    <td>
                        <!--Botones para realizar acciones en cada tupla-->
                        <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Usuarios_Controller.php" method="">
                            <input type="hidden" name=login value=<?php echo $tupla['login'] ?>>
                            <button name="action" value="EDIT" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i></button>&nbsp
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
