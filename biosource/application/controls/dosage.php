<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $dosage = "SELECT * FROM tbl_dosage";

        $sqldos = mysqli_query($connection, $dosage);

        while($dos = mysqli_fetch_assoc($sqldos)) {

            echo '<option data-id="'.$dos['dosage_id'].'" value="'.$dos['dosage_code'].'">'.$dos['dosage_name'].'</option>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
