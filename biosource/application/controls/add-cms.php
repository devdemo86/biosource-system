<?php

    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['name']) && isset($_POST['code'])) {

            $name = $_POST['name'];

            $code = $_POST['code'];

            if($code == 'generic') {

                $slog = strtolower($name);

                $exist = "SELECT * FROM tbl_generic WHERE slog = TRIM('".$slog."')";

                $query = mysqli_query($connection, $exist);

                if($query->num_rows == 0) {

                    $insert = "INSERT INTO tbl_generic VALUES('', generic_code + 1, '".$name."', '".str_replace(' ', '-', $slog)."')";

                    $sql = mysqli_query($connection, $insert);

                    if((int) $sql == 1) {

                        echo 'success';

                    } else {

                        echo 'error';

                    }

                } else {

                    echo 'exist';

                }

            } else if($code == 'dosage') {

                $slog = strtolower($name);

                $exist = "SELECT * FROM tbl_dosage WHERE slog = TRIM('".$slog."')";

                $query = mysqli_query($connection, $exist);

                if($query->num_rows == 0) {

                    $insert = "INSERT INTO tbl_dosage VALUES('', dosage_code + 1, '".$name."', '".str_replace(' ', '-', $slog)."')";

                    $sql = mysqli_query($connection, $insert);

                    if((int) $sql == 1) {

                        echo 'success';

                    } else {

                        echo 'error';

                    }

                } else {

                    echo 'exist';

                }

            } else if($code == 'variant') {

                $slog = strtolower($name);

                $exist = "SELECT * FROM tbl_variant WHERE slog = TRIM('".$slog."')";

                $query = mysqli_query($connection, $exist);

                if($query->num_rows == 0) {

                    $insert = "INSERT INTO tbl_variant VALUES('', '".$name."', '".str_replace(' ', '-', $slog)."')";

                    $sql = mysqli_query($connection, $insert);

                    if((int) $sql == 1) {

                        echo 'success';

                    } else {

                        echo 'error';

                    }

                } else {

                    echo 'exist';

                }

            } else {

                $slog = strtolower($name);

                $exist = "SELECT * FROM tbl_category WHERE slog = TRIM('".$slog."')";

                $query = mysqli_query($connection, $exist);

                if($query->num_rows == 0) {

                    $insert = "INSERT INTO tbl_category VALUES('', category_code + 1, '".$name."', '".str_replace(' ', '-', $slog)."')";

                    $sql = mysqli_query($connection, $insert);

                    if((int) $sql == 1) {

                        echo 'success';

                    } else {

                        echo 'error';

                    }

                } else {

                    echo 'exist';

                }

            }

        } else {

            header("Location: ../errors/dberror");

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
