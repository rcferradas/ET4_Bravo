<?php

class Index {

    function __construct() {
        $this->render();
    }

    function render() {

        include '../Locales/Strings_SPANISH.php';
        include '../Views/Header.php';
        include '../Views/Footer.php';
    }

}

?>