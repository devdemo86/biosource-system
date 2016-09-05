<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['supplier'])) {

            $credentials = '';

            foreach ($_POST['supplier'] as $key => $info) {

                $credentials .= "'".$info['value']."'";

                if($info !== end($_POST['supplier'])) {

                    $credentials .= ', ';

                }

            }

            $query = "INSERT INTO tbl_supplier(`supplier_name`, `supplier_contact`, `supplier_address`) VALUES(".$credentials.")";

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
