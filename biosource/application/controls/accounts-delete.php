<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['userid'])) {

            $query = "UPDATE tbl_status SET status_remarks = 0 WHERE user_id = ".$_POST['userid'];

            $sql = mysqli_query($connection, $query);

            if((int) $sql === 1) {

                echo 'success';

            } else {

                echo 'id-error';

            }

        } else if(isset($_POST['user'])) {



        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
