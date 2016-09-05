<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "DELETE FROM tbl_checkout WHERE checkout_id = ".$_POST['delid'];

        $sql = mysqli_query($connection, $query);

        if((int) $sql === 1) {

            echo 'success';

        } else {

            echo 'id-error';

        }

    } else {

        header("Location: ../login");

    }

?>
