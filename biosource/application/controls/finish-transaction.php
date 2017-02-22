<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['ids'])) {

            $response = false;

            $ids = explode('|', $_POST['ids']);

            foreach($ids as $id) {

                $query = "UPDATE tbl_transaction SET is_finish = 1 WHERE trans_id = ".$id;

                $result = mysqli_query($connection, $query);

                if(!$result) {

                    echo 'error';

                    exit();

                }

                $response = true;

            }

            if($response) {

                echo 'user-home';

            }

        } else {

            echo 'error';

        }

    } else {

        header('Location: ../login');

    }

?>
