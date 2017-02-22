<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['proceed'])) {

            $cashier = $_SESSION['user_id'];

            $citizen = $_POST['citizen'];

            $finalprice = $_POST['total'];

            $amount = $_POST['amount'];

            $checkout = "SELECT * FROM tbl_checkout WHERE user_id = '".$cashier."' AND DATE(checkout_date) = CURDATE()";

            $sqlcheckount = mysqli_query($connection, $checkout);

            $response = false;

            while($checkout_row = mysqli_fetch_assoc($sqlcheckount)) {

                $query = "INSERT INTO tbl_transaction(`trans_citizen`, `trans_price`, `trans_cashier`, `amount`, `trans_qtypiece`, `trans_qtybox`, `trans_type`, `item_id`)";
                $query .= "VALUES('".$citizen."', '".$finalprice."', '".$cashier."', '".$amount."', ".$checkout_row['checkout_qtypiece'].", ".$checkout_row['checkout_qtybox'].", '".$checkout_row['checkout_type']."', ".$checkout_row['item_id'].")";

                $sql = mysqli_query($connection, $query);

                $id = mysqli_insert_id($connection);

                switch (strlen($id)) {
                    case 2:
                        $id = '0000'.$id;
                        $response = true;
                        break;
                    case 3:
                        $id = '000'.$id;
                        $response = true;
                        break;
                    case 4:
                        $id = '00'.$id;
                        $response = true;
                        break;
                    case 5:
                        $id = '0'.$id;
                        $response = true;
                        break;
                    default:
                        $id = '000000'.$id;
                        $response = true;
                        break;
                }

            }

            if($response) {

                $querytrunc = "TRUNCATE TABLE `tbl_checkout`";

                $sqltrunc = mysqli_query($connection, $querytrunc);

                if((int) $sqltrunc === 1) {

                    echo $id;

                } else {

                    echo 'id-error';

                }

            } else {

                echo 'id-error';

            }

        } else {

            echo 'invalid';

        }

    } else {

        header("Location: ../login");

    }

?>
