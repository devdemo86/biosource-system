<?php

    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $type = $_POST['type'] == 'generic' ? 'product' : 'brand';

        $query = "UPDATE tbl_".$type." SET has_barcode = 1 WHERE ".$type."_id = ".$_POST['id'];

        $result = mysqli_query($connection, $query);

        if((int) $result === 1) {

            echo 'success';

        } else {

            echo 'error';

        }

    } else {

        header('Location: ../login');

    }

?>
