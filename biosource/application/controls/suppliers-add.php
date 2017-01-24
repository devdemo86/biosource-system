<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['supplier'])) {

            $supplier = $_POST['supplier'];

            $name = strtolower($supplier[0]['value']);

            $contact = strtolower($supplier[1]['value']);

            $address = strtolower($supplier[2]['value']);

            $exist = "SELECT supplier_id FROm tbl_supplier WHERE supplier_name = '".$name."' AND supplier_contact = '".$contact."' AND supplier_address = '".$address."'";

            $query = mysqli_query($connection, $exist);

            if($query->num_rows == 0) {

                $insert = "INSERT INTO tbl_supplier(`supplier_name`, `supplier_contact`, `supplier_address`) VALUES('".$name."', '".$contact."', '".$address."')";

                $sql = mysqli_query($connection, $insert);

                if((int) $sql === 1) {

                    echo 'success';

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
