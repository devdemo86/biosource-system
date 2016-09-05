<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['user'])) {

            $query = "SELECT * FROM tbl_user u INNER JOIN tbl_status s ON u.user_id = s.user_id WHERE u.user_id = ".$_POST['user'];

            $sql = mysqli_query($connection, $query);

            $account = mysqli_fetch_assoc($sql);

            echo json_encode($account);

        } else if(isset($_POST['userupdate']) && isset($_POST['userid'])) {

            $credentials = '';

            foreach ($_POST['userupdate'] as $key => $info) {

                $index = str_replace('-', '_', $info['name']);

                $credentials .= $index === 'status_contact' ? 'tbl_status.' : 'tbl_user.';

                $credentials .= $index.' = "'.$info['value'].'"';

                if($info !== end($_POST['userupdate'])) {

                    $credentials .= ', ';

                }

            }

            $update = "UPDATE tbl_user, tbl_status SET ".$credentials." WHERE tbl_user.user_id = tbl_status.user_id AND tbl_user.user_id = ".$_POST['userid'];

            $sqlupdate = mysqli_query($connection, $update);

            if((int) $sqlupdate === 1) {

                echo 'success';

            } else {

                echo 'error';

            }

        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
