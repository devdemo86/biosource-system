<?php

    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['name']) && isset($_POST['code'])) {

            $name = $_POST['name'];

            $code = $_POST['code'];

            if($code == 'generic') {

                $query = "INSERT INTO tbl_generic VALUES('', generic_code + 1, '".$name."')";

                $sql = mysqli_query($connection, $query);

                if((int) $sql == 1) {

                    echo 'success';

                } else {

                    echo 'error';

                }

            } else if($code == 'dosage') {

                $query = "INSERT INTO tbl_dosage VALUES('', dosage_code + 1, '".$name."')";

                $sql = mysqli_query($connection, $query);

                if((int) $sql == 1) {

                    echo 'success';

                } else {

                    echo 'error';

                }

            } else {

                $query = "INSERT INTO tbl_category VALUES('', category_code + 1, '".$name."')";

                $sql = mysqli_query($connection, $query);

                if((int) $sql == 1) {

                    echo 'success';

                } else {

                    echo 'error';

                }

            }

        } else {

            header("Location: ../errors/dberror");

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
