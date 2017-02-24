<?php

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT b.brand_id, b.brand_name, v.variant_name FROm tbl_brand b INNER JOIN tbl_variant v ON v.variant_id = b.variant_id WHERE b.has_barcode = 0";

        $result = mysqli_query($connection, $query);

        $htmlcontent = "<select name=\"generated-barcode-details\" class=\"form-control generated-barcode-details\">";

        $htmlcontent .= "<option value=\"\">Select Item</option>";

        while($row = mysqli_fetch_assoc($result)) {

            $htmlcontent .= "<option value=\"".$row['brand_id']."\">".$row['brand_name']." - ".$row['variant_name']."</option>";

        }

        $htmlcontent .= "</select>";

        echo $htmlcontent;

    } else {

        echo 'invalid';

    }

?>
