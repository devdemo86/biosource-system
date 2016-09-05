<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['dataid'])) {

            $id = $_POST['dataid'];

            $type = $_POST['datatype'];

            $query = "SELECT ".$type."_qtyperpiece, ".$type."_qtyperbox FROM tbl_".$type." WHERE ".$type."_id = ".$id;

            $sql = mysqli_query($connection, $query);

            if($sql->num_rows > 0) {

                $sqldata = mysqli_fetch_assoc($sql);

                echo $sqldata[$type.'_qtyperpiece'].'#'.$sqldata[$type.'_qtyperbox'];

            } else {

                echo 'zero';

            }

        } else {

            echo 'id-error';

        }

    } else {

        header("Location: ../login");

    }

?>
