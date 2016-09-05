<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['user'])) {

            $check = "SELECT user_username, user_password FROM tbl_user WHERE user_username = '".$_POST['user'][6]['value']."' AND user_password = '".sha1($_POST['user'][7]['value'])."'";

            $result = mysqli_query($connection, $check);

            if((int) $result->num_rows === 0) {

                $credentials = '';

                foreach ($_POST['user'] as $key => $info) {

                    if($info !== end($_POST['user'])) {

                        if($info['name'] !== $_POST['user'][3]['name']) {

                            $credentials .= "'".$info['value']."'";

                            $credentials .= ', ';

                        }

                    } else {

                        $credentials .= "'".sha1($info['value'])."'";

                    }

                }

                $query = "INSERT INTO tbl_user(`user_fname`, `user_mname`, `user_lname`, `type_id`, `user_address`, `user_username`, `user_password`) VALUES(".$credentials.")";

                $sql = mysqli_query($connection, $query);

                if((int) $sql === 1) {

                    $status = "INSERT INTO tbl_status(`user_id`, `status_contact`) VALUES(".mysqli_insert_id($connection).", '".$_POST['user'][3]['value']."')";

                    $final = mysqli_query($connection, $status);

                    if((int) $final === 1) {

                        echo 'success';

                    } else {

                        echo 'id-error';

                    }

                } else {

                    echo 'id-error';

                }

            } else {

                echo 'exist';

            }

        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
