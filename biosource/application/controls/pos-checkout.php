<?php

    session_start();

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['dataid'])) {

            $id = $_POST['dataid'];

            $type =  $_POST['datatype'];

            $queryselect = "SELECT ".$type."_qtyperpiece, ".$type."_qtyperbox, ".$type."_priceperpiece, ".$type."_priceperbox ";
            $queryselect .= "FROM tbl_".$type." WHERE ".$type."_id = ".$id;

            $sqlselect = mysqli_query($connection, $queryselect);

            if($sqlselect->num_rows > 0) {

                $resultselect = mysqli_fetch_assoc($sqlselect);

                $piece = $resultselect[$type.'_qtyperpiece'];

                $box = $resultselect[$type.'_qtyperbox'];

                $qty = $_POST['info'];

                if($qty[0]['value'] == null) {

                    if($qty[1]['value'] != null) {

                        if($box >= $qty[1]['value']) {

                            $newbox = $box - $qty[1]['value'];

                            $queryupdate = "UPDATE tbl_".$type." SET ".$type."_qtyperbox = ".$newbox." WHERE ".$type."_id = ".$id;

                            $sql = mysqli_query($connection, $queryupdate);

                            if((int) $sql === 1) {

                                $boxprice = $resultselect[$type.'_priceperbox'] * $qty[1]['value'];

                                $select_query = "SELECT * FROM tbl_checkout WHERE item_id = $id AND checkout_type = 'tbl_".$type."'";

                                $select_query_rows = mysqli_query($connection, $select_query);

                                if($select_query_rows && $select_query_rows->num_rows > 0) {

                                    $query_update = "UPDATE tbl_checkout SET checkout_qtybox = (checkout_qtybox + ".$qty[1]['value'].") WHERE item_id = $id AND checkout_type = 'tbl_".$type."'";

                                    $query_update_check = mysqli_query($connection, $query_update);

                                    if((int) $query_update_check === 1) {

                                        echo 'success';

                                    } else {

                                        echo 'id-error';

                                    }

                                } else {

                                    $queryinsert = "INSERT INTO tbl_checkout(`checkout_qtybox`, `user_id`, `item_id`, `checkout_type`) ";
                                    $queryinsert .= "VALUES(".$qty[1]['value'].", ".$_SESSION['user_id'].", ".$id.", 'tbl_".$type."')";

                                    $sqlinsert = mysqli_query($connection, $queryinsert);

                                    if((int) $sqlinsert === 1) {

                                        echo 'success';

                                    } else {

                                        echo 'id-error';

                                    }

                                }

                            } else {

                                echo 'id-error';

                            }

                        } else {

                            echo 'low';

                        }

                    }

                } else if($qty[1]['value'] == null) {

                    if($qty[0]['value'] != null) {

                        if($piece >= $qty[0]['value']) {

                            $newpiece = $piece - $qty[0]['value'];

                            $queryupdate = "UPDATE tbl_".$type." SET ".$type."_qtyperpiece = ".$newpiece." WHERE ".$type."_id = ".$id;

                            $sql = mysqli_query($connection, $queryupdate);

                            if((int) $sql === 1) {

                                $pieceprice = $resultselect[$type.'_priceperpiece'] * $qty[0]['value'];

                                $select_query = "SELECT * FROM tbl_checkout WHERE item_id = $id AND checkout_type = 'tbl_".$type."'";

                                $select_query_rows = mysqli_query($connection, $select_query);

                                if($select_query_rows && $select_query_rows->num_rows > 0) {

                                    $query_update = "UPDATE tbl_checkout SET checkout_qtypiece = (checkout_qtypiece + ".$qty[0]['value'].") WHERE item_id = $id AND checkout_type = 'tbl_".$type."'";

                                    $query_update_check = mysqli_query($connection, $query_update);

                                    if((int) $query_update_check === 1) {

                                        echo 'success';

                                    } else {

                                        echo 'id-error';

                                    }

                                } else {

                                    $queryinsert = "INSERT INTO tbl_checkout(`checkout_qtypiece`, `user_id`, `item_id`, `checkout_type`) ";
                                    $queryinsert .= "VALUES(". $qty[0]['value'].", ".$_SESSION['user_id'].", ".$id.", 'tbl_".$type."')";

                                    $sqlinsert = mysqli_query($connection, $queryinsert);

                                    if((int) $sqlinsert === 1) {

                                        echo 'success';

                                    } else {

                                        echo 'id-error';

                                    }

                                }

                            } else {

                                echo 'id-error';

                            }

                        } else {

                            echo 'low';

                        }

                    }

                } else {

                    if($piece >= $qty[0]['value'] && $box >= $qty[1]['value']) {

                        $newpiece = $piece - $qty[0]['value'];

                        $newbox = $box - $qty[1]['value'];

                        $queryupdate = "UPDATE tbl_".$type." SET ".$type."_qtyperpiece = ".$newpiece.", ".$type."_qtyperbox = ".$newbox." ";
                        $queryupdate .= "WHERE ".$type."_id = ".$id;

                        $sql = mysqli_query($connection, $queryupdate);

                        if((int) $sql === 1) {

                            $pieceprice = $resultselect[$type.'_priceperpiece'] * $qty[0]['value'];

                            $boxprice = $resultselect[$type.'_priceperbox'] * $qty[1]['value'];

                            $price = $pieceprice + $boxprice;

                            $queryinsert = "INSERT INTO tbl_checkout(`checkout_qtypiece`, `checkout_qtybox`, `user_id`, `item_id`, `checkout_type`) ";
                            $queryinsert .= "VALUES(". $qty[0]['value'].", ".$qty[1]['value'].", ".$_SESSION['user_id'].", ".$id.", 'tbl_".$type."')";

                            $sqlinsert = mysqli_query($connection, $queryinsert);

                            if((int) $sql === 1) {

                                echo 'success';

                            } else {

                                echo 'id-error';

                            }

                        } else {

                            echo 'id-error';

                        }

                    } else {

                        echo 'low';

                    }

                }

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
