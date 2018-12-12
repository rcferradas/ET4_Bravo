<?php

class SHOWALL {

    private $datos;

    function __construct($datos) {
        $this->datos = $datos;
        $this->showAllContratos();
    }

    //Mostrar tabla SHOWALL
    function showAllContratos() {
        include_once '../Views/Header.php';
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col"><?php echo $strings['Código']; ?></th>
                    <th scope="col"><?php echo $strings['Centro']; ?></th>
                    <th scope="col"><?php echo $strings['Tipo']; ?></th>
                    <th scope="col"><?php echo $strings['Empresa encargada']; ?></th>
                    <th scope="col"><?php echo $strings['Documento']; ?></th>
                    <th scope="col"><?php echo $strings['Periodo inicio']; ?></th>
                    <th scope="col"><?php echo $strings['Periodo fin']; ?></th>
                    <th scope="col"><?php echo $strings['Importe']; ?></th>
                    <th scope="col"><?php echo $strings['Estado']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($tupla = $this->datos->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $tupla['cod']; ?></td>
                        <td><?php echo $tupla['centro']; ?></td>
                        <td><?php echo $tupla['tipo']; ?></td>
                        <td><?php echo $tupla['empresa']; ?></td>
                        <td><?php echo $tupla['documento']; ?></td>
                        <td><?php echo $tupla['periodoinicio']; ?></td>
                        <td><?php echo $tupla['periodofin']; ?></td>
                        <td><?php echo $tupla['importe']; ?></td>
                        <td><?php echo $tupla['estado']; ?></td>
                        <td>
                            <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Mantenimiento_Controller.php?email=<?php echo $tupla['cod']; ?>" method="post">
                                <button class="btn btn-outline-primary" name="ver" onclick="this.form.submit()">
                                    <i class="far fa-eye"></i></button>&nbsp
                                <button class="btn btn-outline-primary" name="edit" onclick="this.form.submit()">
                                    <i class="fas fa-edit"></i></button>&nbsp
                                <button class="btn btn-outline-primary" name="delete" onclick="this.form.submit()">
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
