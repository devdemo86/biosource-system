<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['user'])) {

            $query = "SELECT * FROM tbl_supplier WHERE supplier_id = ".$_POST['user'];

            $sql = mysqli_query($connection, $query);

            $information = mysqli_fetch_assoc($sql);

            echo json_encode($information);

        } else if(isset($_POST['userid']) && isset($_POST['userdata'])) {

            $credentials = '';

            foreach ($_POST['userdata'] as $key => $info) {

                $index = str_replace('-', '_', $info['name']);

                $credentials .= $index.' = "'.$info['value'].'"';

                if($info !== end($_POST['userdata'])) {

                    $credentials .= ', ';

                }

            }

            $update = "UPDATE tbl_supplier SET ".$credentials." WHERE supplier_id = ".$_POST['userid'];

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
