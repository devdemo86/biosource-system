<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $variant = "SELECT * FROM tbl_variant ORDER BY variant_id ASC";

        $sqlvar = mysqli_query($connection, $variant);

        while($variants = mysqli_fetch_assoc($sqlvar)) {

            echo '<li>'.$variants['variant_name'].'</li>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
