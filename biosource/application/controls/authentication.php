<?php

    if(isset($_POST['userAuth'])) {

        $credentials = [];

        foreach ($_POST['userAuth'] as $user) {
            $credentials[] = $user['value'];
        }

        require_once('config.php');

        require_once('connection.php');

        $sql = "SELECT * FROM tbl_user u INNER JOIN tbl_status s ON u.user_id = s.user_id
                WHERE u.user_username='".$credentials[0]."' AND u.user_password='".sha1($credentials[1])."' AND s.status_remarks = 1";

        $sql_result = mysqli_query($connection, $sql);

        if($sql_result->num_rows > 0) {

            $user = mysqli_fetch_assoc($sql_result);

            session_start();

            $_SESSION = $user;

            if(isset($_SESSION['type_id'])) {

                if((int) $_SESSION['type_id'] === 1) {

                    echo "admin/admin-home";

                } else {

                    echo "user/user-home";

                }

            } else {

                echo "errors/sessionerror";

            }

        } else {

            echo "zero";

        }

    } else {

        header("Location: ../login");

    }

?>
