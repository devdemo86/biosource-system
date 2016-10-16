<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['proceed'])) {

            $citizen = $_POST['citizen'];

            $total = $_POST['total'];

            $finalprice = $citizen == null ? number_format($total, 2) : number_format($total * 0.20 , 2);

            $cashier = $_SESSION['user_id'];

            $query = "INSERT INTO tbl_transaction(`trans_citizen`, `trans_price`, `trans_cashier`) VALUES('".$citizen."', '".$finalprice."', '".$cashier."')";

            $sql = mysqli_query($connection, $query);

            if((int) $sql === 1) {

                $querytrunc = "TRUNCATE TABLE `tbl_checkout`";

                $sqltrunc = mysqli_query($connection, $querytrunc);

                if((int) $sqltrunc === 1) {

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

    } else {

        header("Location: ../login");

    }

?>
