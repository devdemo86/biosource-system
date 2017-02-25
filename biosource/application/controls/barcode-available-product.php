<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT p.product_id, p.product_name, v.variant_name FROm tbl_product p INNER JOIN tbl_variant v ON v.variant_id = p.variant_id WHERE p.has_barcode = 0";

        $result = mysqli_query($connection, $query);

        $htmlcontent = "<select name=\"generated-barcode-details\" class=\"form-control generated-barcode-details\">";

        $htmlcontent .= "<option value=\"\">Select Item for Generic</option>";

        if($result && $result->num_rows > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                $htmlcontent .= "<option value=\"".$row['product_id']."\">".$row['product_name']." - ".$row['variant_name']."</option>";

            }

        }

        $htmlcontent .= "</select>";

        echo $htmlcontent;

    } else {

        echo 'invalid';

    }

?>
