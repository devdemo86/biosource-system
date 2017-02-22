<?php
    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        require_once('../controls/barcode-generator.php');

    } else {

        header('Location: ../login');

    }

?>
