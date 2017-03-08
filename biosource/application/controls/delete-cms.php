<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['deleteType'])) {

            $data = $_POST['deleteType'];

            $query = "DELETE FROM tbl_".$data[0]." WHERE ".$data[0]."_id = ".$data[1];

            $result = mysqli_query($connection, $query);

            if($result) {

                echo 'success';

            } else {

                echo 'error';

            }

        } else {

            echo 'invalid';

        }

    } else {

        echo 'invalid';

    }

?>
