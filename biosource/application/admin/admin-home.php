<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../includes/header.php');

        if((int) $_SESSION['type_id'] === 1 && (int) $_SESSION['status_remarks'] === 1) {

            require_once('home-content.php');

        } else {

            header("Location: ../user/user-home");

        }

        require_once('../includes/footer.php');

    } else {

        header("Location: ../login");

    }

?>
