<?php

    if(isset($_POST['passwords'])) {

        $passwords = [];

        foreach ($_POST['passwords'] as $pass) {

            if(count($passwords) !== 2) {

                $passwords[] = $pass['value'];

            } else {

                break;

            }

        }

        require_once('config.php');

        require_once('connection.php');

        $sql_select = "SELECT user_password FROM tbl_user WHERE user_password='".sha1($passwords[0])."'";

        $sql_result = mysqli_query($connection, $sql_select);

        if($sql_result->num_rows > 0) {

            $sql_update = "UPDATE tbl_user SET user_password='".sha1($passwords[1])."' WHERE user_password='".sha1($passwords[0])."'";

            $sql_response = mysqli_query($connection, $sql_update);

            if((int) $sql_response === 1) {

                echo "success";

            } else {

                echo "error";

            }

        } else {

            echo 'zero';

        }

    } else {

        header("Location: ../login");

    }

?>
