<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['product'])) {

            $slog = strtolower($_POST['product'][0]['value']);

            $exist = "SELECT product_id FROM tbl_product WHERE product_name = '".$slog."'";

            $queryexist = mysqli_query($connection, $exist);

            if($queryexist->num_rows == 0) {

                $product = '';

                foreach ($_POST['product'] as $key => $info) {

                    $product .= "'".$info['value']."'";

                    if($info !== end($_POST['product'])) {

                        $product .= ', ';

                    }

                }

                $insert = "tbl_product(`product_name`, `generic_code`, `dosage_code`, `category_code`, `product_qtyperbox`, `product_qtyperpiece`, `product_priceperpiece`,";
                $insert .= " `product_priceperbox`, `product_expiration`, `product_holdingcost`, `product_orderingcost`, `product_totalqtyperbox`, `product_supplier`)";

                $query = "INSERT INTO ".$insert." VALUES(".$product.")";

                $sql = mysqli_query($connection, $query);

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
