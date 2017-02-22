<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['type'])) {

            $queryprod = "SELECT p.product_name, p.product_id, p.product_qtyperbox, p.product_qtyperpiece, v.variant_name FROM tbl_product p INNER JOIN tbl_variant v ON v.variant_id = p.variant_id WHERE p.product_qtyperbox <= 100 AND p.product_qtyperpiece <= 100 AND p.product_supplier = '".$_POST['selected']."'";

            $prod = mysqli_query($connection, $queryprod);

            $htmlcontent = '';

            if($prod && $prod->num_rows > 0) {

                while($prod_row = mysqli_fetch_assoc($prod)) {

                    $htmlcontent .= "<span data-code=\"product\" data-id=".$prod_row['product_id']." class=\"label label-critical-supplier label-danger\">".$prod_row['product_name']." - ".$prod_row['variant_name']."( ".($prod_row['product_qtyperbox']." / ".$prod_row['product_qtyperpiece'])." )</span>";

                }

            }

            $querybrand = "SELECT b.brand_name, b.brand_id, b.brand_qtyperbox, b.brand_qtyperpiece, v.variant_name FROM tbl_brand b INNER JOIN tbl_variant v ON v.variant_id = b.variant_id WHERE b.brand_qtyperbox <= 100 AND b.brand_qtyperpiece <= 100 AND b.brand_supplier = '".$_POST['selected']."'";

            $brand = mysqli_query($connection, $querybrand);

            if($brand && $brand->num_rows > 0) {

                while($brand_row = mysqli_fetch_assoc($brand)) {

                    $htmlcontent .= "<span data-code=\"brand\" data-id=".$brand_row['brand_id']." class=\"label label-critical-supplier label-danger\">".$brand_row['brand_name']." - ".$brand_row['variant_name']."( ".($brand_row['brand_qtyperbox']." / ".$brand_row['brand_qtyperpiece'])." )</span>";

                }

            }

            if(empty($htmlcontent) || is_null($htmlcontent)) {

                $htmlcontent = 'No critical or out of stock item.';

            }

            echo $htmlcontent;

        } else {

            echo 'No supplier selected';

        }

    } else {

        echo 'invalid';

    }

?>
