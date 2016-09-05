<?php

    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['prodid'])) {

            $query = "SELECT * FROM tbl_product WHERE product_id = ".$_POST['prodid'];

            $sql = mysqli_query($connection, $query);

            $productitem = mysqli_fetch_assoc($sql);

            $content = '';
            $content .= '<div class="form-group">';
                $content .= '<label for="product-name">Product Name:</label>';
                $content .= '<input type="text" name="product-name" class="form-control" value="'.$productitem['product_name'].'" ';
                $content .= 'placeholder="Product Name" required="required">';
            $content .= '</div>';
            $content .= '<div class="form-group clearfix">';
                $content .= '<div class="col-lg-12">';
                    $content .= '<div class="row">';
                        $content .= '<div class="no-padding-left col-lg-6">';
                            $content .= '<label for="generic-name">Generic Name:</label>';
                            $content.= '<select name="generic-code" class="form-control" required="required">';
                                $content .= '<option value="">Available</option>';

                                $generic = "SELECT * FROM tbl_generic";

                                $sqlgen = mysqli_query($connection, $generic);

                                while($gen = mysqli_fetch_assoc($sqlgen)) {

                                    $content .= '<option data-id="'.$gen['generic_id'].'" value="'.$gen['generic_code'].'" ';

                                    if($gen['generic_code'] == $productitem['generic_code']) {

                                        $content .= 'selected="selected"';

                                    }

                                    $content .= '>'.$gen['generic_name'].'</option>';

                                }

                            $content.= '</select>';
                        $content .= '</div>';
                        $content .= '<div class="no-padding col-lg-6">';
                            $content .= '<label for="dosage-code">Dosage:</label>';
                            $content.= '<select name="dosage-code" class="form-control" required="required">';
                                $content .= '<option value="">Available</option>';

                                $dosage = "SELECT * FROM tbl_dosage";

                                $sqldos = mysqli_query($connection, $dosage);

                                while($dos = mysqli_fetch_assoc($sqldos)) {

                                    $content .= '<option data-id="'.$dos['dosage_id'].'" value="'.$dos['dosage_code'].'" ';

                                    if($dos['dosage_code'] == $productitem['dosage_code']) {

                                        $content .= 'selected="selected"';

                                    }

                                    $content .= '>'.$dos['dosage_name'].'</option>';

                                }

                            $content.= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="form-group clearfix mb0">';
                $content .= '<div class="col-lg-12">';
                    $content .= '<div class="row">';
                        $content .= '<div class="no-padding-left col-lg-6 form-group">';
                            $content .= '<label for="category-code">Category Name:</label>';
                            $content.= '<select name="category-code" class="form-control" required="required">';
                                $content .= '<option value="">Available</option>';

                                $category = "SELECT * FROM tbl_category";

                                $sqlcat = mysqli_query($connection, $category);

                                while($cat = mysqli_fetch_assoc($sqlcat)) {

                                    $content .= '<option data-id="'.$cat['category_id'].'" value="'.$cat['category_code'].'" ';

                                    if($cat['category_code'] == $productitem['category_code']) {

                                        $content .= 'selected="selected"';

                                    }

                                    $content .= '>'.$cat['category_name'].'</option>';

                                }

                            $content.= '</select>';
                        $content .= '</div>';
                        $content .= '<div class="no-padding col-lg-6 form-group">';
                            $content .= '<label for="prod-qtyperbox">Quantity (Box):</label>';
                            $content .= '<input type="number" name="product-qtyperbox" class="form-control" placeholder="Box" value="'.$productitem['product_qtyperbox'].'" ';
                            $content . 'required="required">';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="form-group clearfix">';
                $content .= '<div class="col-lg-12">';
                    $content .= '<div class="row">';
                        $content .= '<div class="no-padding-left col-lg-4">';
                            $content .= '<label for="prod-qtyperpiece">Price (Piece):</label>';
                            $content .= '<input type="number" name="product-qtyperpiece" class="form-control" placeholder="Piece" ';
                            $content .= 'value="'.$productitem['product_qtyperpiece'].'" required="required">';
                        $content .= '</div>';
                        $content .= '<div class="no-padding-left col-lg-4">';
                            $content .= '<label for="prod-qtyperbox">Price (Box):</label>';
                            $content .= '<input type="number" name="product-priceperbox" class="form-control" placeholder="Box" ';
                            $content .= 'value="'.$productitem['product_priceperbox'].'" required="required">';
                        $content .= '</div>';
                        $content .= '<div class="no-padding col-lg-4">';
                            $content .= '<label for="prod-qtyperbox">Expiration Date:</label>';
                            $content .= '<input type="date" class="form-control" placeholder="Date" value="'.$productitem['product_expiration'].'" ';
                            $content .= 'name="product-expiration" required="required">';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="form-group clearfix mb0">';
                $content .= '<div class="col-lg-12">';
                    $content .= '<div class="row">';
                        $content .= '<div class="no-padding-left col-lg-6">';
                            $content .= '<label for="holdingcost">Price (Piece):</label>';
                            $content .= '<input type="number" name="product-holdingcost" class="form-control" placeholder="Holding Cost" ';
                            $content .= 'value="'.$productitem['product_holdingcost'].'" required="required">';
                        $content .= '</div>';
                        $content .= '<div class="no-padding col-lg-6">';
                            $content .= '<label for="orderingcost">Price (Box):</label>';
                            $content .= '<input type="number" name="product-orderingcost" class="form-control" placeholder="Order Cost" ';
                            $content .= 'value="'.$productitem['product_orderingcost'].'" required="required">';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<span class="help-block process-block hidden"></span>';
            $content .= '<div class="alert alert-success process-alert-success hidden mb0" role="alert">';
                $content .= '<strong>Well done!</strong> You have successfully update your product.';
            $content .= '</div>';
            $content .= '<div class="alert alert-danger process-alert-error hidden mb0" role="alert">';
                $content .= '<strong>Oooops!</strong> Change a few things up and try submitting again.';
            $content .= '</div>';

            echo $content;

        } else if(isset($_POST['updateid']) && isset($_POST['product'])) {

            $product = '';

            foreach ($_POST['product'] as $key => $item) {

                $index = str_replace('-', '_', $item['name']);

                $converted = is_numeric($item['value']) ? $item['value'] : '"'.$item['value'].'"';

                $product .= $index.' = '.$converted;

                if($item !== end($_POST['product'])) {

                    $product .= ', ';

                }

            }

            $query = "UPDATE tbl_product SET ".$product." WHERE product_id = ".$_POST['updateid'];

            $sql = mysqli_query($connection, $query);

            if((int) $sql === 1) {

                echo 'success';

            } else {

                echo 'error';

            }

        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
