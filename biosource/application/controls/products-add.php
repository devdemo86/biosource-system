<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['product'])) {

            $product = '';

            foreach ($_POST['product'] as $key => $info) {

                $product .= "'".$info['value']."'";

                if($info !== end($_POST['product'])) {

                    $product .= ', ';

                }

            }

            $insert = "tbl_product(`product_name`, `generic_code`, `dosage_code`, `category_code`, `product_qtyperbox`, `product_qtyperpiece`, `product_priceperpiece`,";
            $insert .= " `product_priceperbox`, `product_expiration`, `product_holdingcost`, `product_orderingcost`, `product_totalqtyperbox`)";

            $query = "INSERT INTO ".$insert." VALUES(".$product.")";

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