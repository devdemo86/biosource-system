<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['brand'])) {

            $slog = strtolower($_POST['brand'][0]['value']);

            $exist = "SELECT brand_id FROM tbl_brand WHERE brand_name = '".$slog."'";

            $queryexist = mysqli_query($connection, $exist);

            if($queryexist->num_rows == 0) {

                $brand = '';

                foreach ($_POST['brand'] as $key => $info) {

                    $brand .= "'".$info['value']."'";

                    if($info !== end($_POST['brand'])) {

                        $brand .= ', ';

                    }

                }

                $insert = "tbl_brand(`brand_name`, `generic_code`, `dosage_code`, `category_code`, `brand_qtyperbox`, `brand_qtyperpiece`, `brand_priceperpiece`,";
                $insert .= " `brand_priceperbox`, `brand_expiration`, `brand_holdingcost`, `brand_orderingcost`, `brand_totalqtyperbox`)";

                $query = "INSERT INTO ".$insert." VALUES(".$brand.")";

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
