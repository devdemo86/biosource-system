<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $category = "SELECT * FROM tbl_category";

        $sqlcat = mysqli_query($connection, $category);

        while($cat = mysqli_fetch_assoc($sqlcat)) {

            echo '<option data-id="'.$cat['category_id'].'" value="'.$cat['category_code'].'">'.$cat['category_name'].'</option>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
