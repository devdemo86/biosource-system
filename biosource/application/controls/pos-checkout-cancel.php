<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['trunc'])) {

            $query = "SELECT * FROM tbl_checkout";

            $items = mysqli_query($connection, $query);

            $proceed = false;

            foreach($items as $item) {

                $update = '';

                if($item['checkout_type'] == 'tbl_product') {

                    $update = "UPDATE tbl_product SET product_qtyperpiece = (product_qtyperpiece + ".$item['checkout_qtypiece']."), product_qtyperbox = (product_qtyperbox + ".$item['checkout_qtybox'].") WHERE product_id = ".$item['item_id'];

                } else {

                    $update = "UPDATE tbl_brand SET brand_qtyperpiece = (brand_qtyperpiece + ".$item['checkout_qtypiece']."), brand_qtyperbox = (brand_qtyperbox + ".$item['checkout_qtybox'].") WHERE brand_id = ".$item['item_id'];

                }

                $result_update = mysqli_query($connection, $update);

                $proceed = $result_update ? true : false;

            }

            if($proceed) {

                $query = "TRUNCATE TABLE `tbl_checkout`";

                $sql = mysqli_query($connection, $query);

                if((int) $sql === 1) {

                    echo 'success';

                } else {

                    echo 'id-error';

                }

            }

        } else {

            echo 'id-error';

        }

    } else {

        header("Location: ../login");

    }

?>
