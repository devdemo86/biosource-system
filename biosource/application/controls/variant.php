<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $variantquery = "SELECT * FROM tbl_variant ORDER BY variant_id ASC";

        $sqlvariant = mysqli_query($connection, $variantquery);

        while($variant = mysqli_fetch_assoc($sqlvariant)) {

            echo '<option value="'.$variant['variant_id'].'">'.$variant['variant_name'].'</option>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
