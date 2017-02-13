<?php

    require_once('../controls/config.php');

    require_once('../controls/connection.php');

    $account = $_POST['accountModify'];

    if(isset($account[0]) && isset($account[1])) {

        $query = 'SELECT user_id FROM tbl_user WHERE user_username = "'.$account[0].'"';

        $result_row = mysqli_query($connection, $query);

        if($result_row->num_rows > 0) {

            $update = 'UPDATE tbl_user SET user_password = "'.sha1($account[1]).'" WHERE user_username = "'.$account[0].'"';

            $result_row_update = mysqli_query($connection, $update);

            print_r($result_row_update);

        } else {

            echo 'zero';

        }

    } else {

        header('Location: ../login.php');

    }

?>
