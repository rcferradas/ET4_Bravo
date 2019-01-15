<?php

class MESSAGE {

    private $string;
    private $volver;

    function __construct($string, $volver) {
        $this->string = $string;
        $this->volver = $volver;
        $this->render();
    }

    function render() {

        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        include '../Views/Header.php';
        ?>
        <br>
        <br>
        <br>
        <p>
        <H3>
            <?php
            echo $strings[$this->string];
            ?>
        </H3>
        </p>
        <br>
        <br>
        <br>
                 
        <?php
        echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
        include '../Views/Footer.php';
    }

//fin metodo render
}
