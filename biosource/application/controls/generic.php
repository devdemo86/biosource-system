<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $generic = "SELECT * FROM tbl_generic";

        $sqlgen = mysqli_query($connection, $generic);

        while($gen = mysqli_fetch_assoc($sqlgen)) {

            echo '<option data-id="'.$gen['generic_id'].'" value="'.$gen['generic_code'].'">'.$gen['generic_name'].'</option>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
