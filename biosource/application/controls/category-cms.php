<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $generic = "SELECT * FROM tbl_category ORDER BY category_id ASC";

        $sqlgen = mysqli_query($connection, $generic);

        while($gen = mysqli_fetch_assoc($sqlgen)) {

            echo '<li>'.$gen['category_name'].'</li>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
