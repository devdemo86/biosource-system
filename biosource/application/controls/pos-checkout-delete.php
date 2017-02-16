<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $select = "SELECT * FROM tbl_checkout WHERE checkout_id = ".$_POST['delid'];

        $query_select = mysqli_query($connection, $select);

        $result = mysqli_fetch_assoc($query_select);

        $update = '';

        if($result['checkout_type'] == 'tbl_product') {

            $update = "UPDATE tbl_product SET product_qtyperpiece = (product_qtyperpiece + ".$result['checkout_qtypiece']."), product_qtyperbox = (product_qtyperbox + ".$result['checkout_qtybox'].") WHERE product_id = ".$result['item_id'];

        } else {

            $update = "UPDATE tbl_brand SET brand_qtyperpiece = (brand_qtyperpiece + ".$result['checkout_qtypiece']."), brand_qtyperbox = (brand_qtyperbox + ".$result['checkout_qtybox'].") WHERE brand_id = ".$result['item_id'];

        }

        $result_update = mysqli_query($connection, $update);

        if($result_update) {

            $query = "DELETE FROM tbl_checkout WHERE checkout_id = ".$_POST['delid'];

            $sql = mysqli_query($connection, $query);

            if((int) $sql === 1) {

                echo 'success';

            } else {

                echo 'id-error';

            }

        }

    } else {

        header("Location: ../login");

    }

?>
