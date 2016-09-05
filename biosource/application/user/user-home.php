<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../includes/header.php');

        require_once('home-pos-content.php');

        require_once('../includes/footer.php');

    } else {

        header("Location: ../login");

    }

?>
