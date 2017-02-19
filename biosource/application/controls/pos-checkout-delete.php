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

            $appendquery = '';

            if(count($_POST['howMany']) == 1) {

                if($_POST['howMany'][0]['name'] == 'delete-how-many-piece') {

                    $appendquery = "product_qtyperpiece = (product_qtyperpiece + ".$_POST['howMany'][0]['value'].")";

                } else {

                    $appendquery = "product_qtyperbox = (product_qtyperbox + ".$_POST['howMany'][1]['value'].")";

                }

            } else {

                $appendquery = "product_qtyperpiece = (product_qtyperpiece + ".$_POST['howMany'][0]['value']."), product_qtyperbox = (product_qtyperbox + ".$_POST['howMany'][1]['value'].")";

            }

            $update = "UPDATE tbl_product SET ".$appendquery." WHERE product_id = ".$result['item_id'];

        } else {

            $appendquery = '';

            if(count($_POST['howMany']) == 1) {

                if($_POST['howMany'][0]['name'] == 'delete-how-many-piece') {

                    $appendquery = "brand_qtyperpiece = (brand_qtyperpiece + ".$_POST['howMany'][0]['value'].")";

                } else {

                    $appendquery = "brand_qtyperbox = (brand_qtyperbox + ".$_POST['howMany'][1]['value'].")";

                }

            } else {

                $appendquery = "brand_qtyperpiece = (brand_qtyperpiece + ".$_POST['howMany'][0]['value']."), brand_qtyperbox = (brand_qtyperbox + ".$_POST['howMany'][1]['value'].")";

            }

            $update = "UPDATE tbl_brand SET ".$appendquery." WHERE brand_id = ".$result['item_id'];

        }

        $result_update = mysqli_query($connection, $update);

        if($result_update) {

            $query = '';

            $checkitempiece = 0;

            $checkitembox = 0;

            if(count($_POST['howMany']) != 1) {

                $checkitempiece = $result['checkout_qtypiece'] - $_POST['howMany'][0]['value'];

                $checkitembox = $result['checkout_qtybox'] - $_POST['howMany'][1]['value'];

            } else {

                if($_POST['howMany'][0]['name'] == 'delete-how-many-piece') {

                    $checkitempiece = $result['checkout_qtypiece'] - $_POST['howMany'][0]['value'];

                } else {

                    $checkitembox = $result['checkout_qtybox'] - $_POST['howMany'][1]['value'];

                }

            }

            if($checkitempiece == 0 && $checkitembox == 0) {

                $query = "DELETE FROM tbl_checkout WHERE checkout_id = ".$_POST['delid'];

            } else {

                $query = "UPDATE tbl_checkout SET checkout_qtypiece = ".$checkitempiece.", checkout_qtybox = ".$checkitembox." WHERE checkout_id = ".$_POST['delid'];

            }

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
