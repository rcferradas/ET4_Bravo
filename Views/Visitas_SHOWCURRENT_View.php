<?php
include_once '../Functions/Authentication.php';

class Visitas_SHOWCURRENT_View {

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
                    <th scope="col"><?php echo $strings['Estado']; ?></th>
                    <th scope="col"><?php echo $strings['Tipo']; ?></th>
                    <th scope="col"><?php echo $strings['Informe']; ?></th>
                    <th scope="col"><?php echo $strings['Fecha']; ?></th>
                    <th scope="col"><?php echo $strings['Visita Padre']; ?></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?php echo $tupla['estado']; ?></td>
                    <td><?php echo $tupla['tipo']; ?></td>
                    <td width="25%"><IMG src="<?php echo $tupla['informe']; ?>" height="10%" width="70%" alt="No se ha encontrado el resguardo"/></td>
                    <td><?php echo $tupla['fecha']; ?></td>
                     <td>
                      <?php if(isset($tupla['frutoVisitaProg'])){ $padre=$tupla['frutoVisitaProg'];$cont= $tupla['codContrato'];echo '<form class="form-inline my-2 my-lg-0" name="formulario12" action="../Controllers/Visitas_Controller.php" method="">
                        <input type="hidden" name="codvisita" value= '.$padre.' >
                        <input type="hidden" name="codcontrato" value=<?php echo $tupla['.$cont.']>
                        <button name="action" value="SHOWCURRENT" type="submit" class="btn btn-outline-primary">
                       <i class="fa fa-arrow-up"></i></button></td>
                          </form>';
                         echo $tupla['frutoVisitaProg'];
                           } ?>
                    <td>
                        <!--Botones para realizar acciones en la tupla-->
                        <form class="form-inline my-2 my-lg-0" name='formulario' action="../Controllers/Visitas_Controller.php" method="">
                            <input type="hidden" name='codvisita' value=<?php echo $tupla['codVisita'] ?>>
                            <input type="hidden" name='codcontrato' value=<?php echo $tupla['codContrato'] ?>>
                            <button name="action" value="EDIT" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i></button>&nbsp
                            <button name="action" value="DELETE" type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-trash-alt"></i></button>&nbsp
                           <?php 
                                     if($tupla['estado']== 'incidencia'){
                                     echo '<button name="action" value="INCIDENCIA" type="submit" class="btn btn-outline-primary">';
                                     echo '<i class="fas fa-plus"></i></button>&nbsp';
                                     }
                                             ?>
                                <button name="action" value="SHOWALL" type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-arrow-left"></i></button>&nbsp
                                
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        include '../Views/Footer.php';
    }

}
?>
