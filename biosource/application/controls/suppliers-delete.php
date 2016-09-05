<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['user'])) {



        } else if(isset($_POST['userid'])) {

            $query = "UPDATE tbl_supplier SET supplier_status = 0 WHERE supplier_id = ".$_POST['userid'];

            $sql = mysqli_query($connection, $query);

            if((int) $sql === 1) {

                echo 'success';

            } else {

                echo 'id-error';

            }

        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
