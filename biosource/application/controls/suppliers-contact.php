<?php

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $contact = "SELECT supplier_contact FROM tbl_supplier";

        $sqlcon = mysqli_query($connection, $contact);

        while($con = mysqli_fetch_assoc($sqlcon)) {

            echo '<option value="'.$con['supplier_contact'].'">'.$con['supplier_contact'].'</option>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
