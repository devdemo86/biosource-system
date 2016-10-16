<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['type'])) {

            $type = $_POST['type'];

            if($type == 'summary-accounts') {

                $query = "SELECT * FROM tbl_user";

                $sql = mysqli_query($connection, $query);

                $content = '<div class="table-responsive">';
                    $content .= '<table class="table">';
                        $content .= '<thead>';
                            $content .= '<tr>';
                                $content .= '<th>Full Name</th>';
                                $content .= '<th class="text-center">Status</th>';
                                $content .= '<th class="text-center">Type</th>';
                            $content .= '</tr>';
                        $content .= '</thead>';
                        $content .= '<tbody>';

                        while($account = mysqli_fetch_assoc($sql)) {

                            $content .= '<tr>';
                                $content .= '<td>';
                                    $content .= $account['user_fname'].' '.$account['user_mname'].' '.$account['user_lname'];
                                $content .= '</td>';
                                $content .= '<td class="text-center">';

                                $stats = "SELECT status_remarks FROM tbl_status WHERE user_id = ".$account['user_id'];

                                $stat_remarks = mysqli_query($connection, $stats);

                                $stats_account = mysqli_fetch_assoc($stat_remarks);

                                if($stats_account['status_remarks'] == 1) {

                                    $content .= '<span class="label label-success">Active</span>';

                                } else {

                                    $content .= '<span class="label label-danger">Inactive</span>';

                                }

                                $content .= '</td>';
                                $content .= '<td class="text-center">';

                                if($account['type_id'] == 1) {

                                    $content .= 'Admin';

                                } else {

                                    $content .= 'Cashier';

                                }

                                $content .= '</td>';
                            $content .= '</tr>';
                        }

                        $content .= '</tbody>';
                    $content .= '</table>';
                $content .= '</div>';

                echo $content;

            } else if($type == 'summary-suppliers') {

                $query = "SELECT * FROM tbl_supplier";

                $sql = mysqli_query($connection, $query);

                if($sql->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Full Name</th>';
                                    $content .= '<th>Contact</th>';
                                    $content .= '<th class="text-center">Status</th>';
                                    $content .= '<th class="text-center">Date Joined</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($account = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>';
                                        $content .= $account['supplier_name'];
                                    $content .= '</td>';
                                    $content .= '<td>';
                                        $content .= $account['supplier_contact'];
                                    $content .= '</td>';
                                    $content .= '<td class="text-center">';

                                    if($account['supplier_status'] == 1) {

                                        $content .= '<span class="label label-success">Active</span>';

                                    } else {

                                        $content .= '<span class="label label-danger">Inactive</span>';

                                    }

                                    $content .= '</td>';
                                    $content .= '<td class="text-center">';
                                        $content .= date('F d, Y', strtotime($account['supplier_date']));
                                    $content .= '</td>';
                                $content .= '</tr>';
                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No supplier available.</span></h3>';

                }

                echo $content;

            } if($type == 'summary-brands') {

                $query = "SELECT * FROM tbl_brand b INNER JOIN tbl_generic g ON b.generic_code = g.generic_code INNER JOIN tbl_category c ON ";
                $query .= "b.category_code = c.category_code INNER JOIN tbl_dosage d ON b.dosage_code = d.dosage_code ORDER BY b.brand_name ASC";

                $sql = mysqli_query($connection, $query);

                if($sql->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Brand Name</th>';
                                    $content .= '<th>Generic Name</th>';
                                    $content .= '<th class="text-center">Dosage</th>';
                                    $content .= '<th class="text-center">Category</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($brand = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$brand['brand_name'].'</td>';
                                    $content .= '<td>'.$brand['generic_name'].'</td>';
                                    $content .= '<td class="text-center">'.$brand['dosage_name'].'</td>';
                                    $content .= '<td class="text-center">'.$brand['category_name'].'</td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No brand available.</span></h3>';

                }

                echo $content;

            } else if($type == 'summary-products') {

                $query = "SELECT * FROM tbl_product p INNER JOIN tbl_generic g ON p.generic_code = g.generic_code INNER JOIN tbl_category c ON p.category_code = c.category_code";
                $query .= " INNER JOIN tbl_dosage d ON p.dosage_code = d.dosage_code ORDER BY p.product_name ASC";

                $sql = mysqli_query($connection, $query);

                if($sql->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Product Name</th>';
                                    $content .= '<th>Generic Name</th>';
                                    $content .= '<th class="text-center">Dosage</th>';
                                    $content .= '<th class="text-center">Category</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($product = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$product['product_name'].'</td>';
                                    $content .= '<td>'.$product['generic_name'].'</td>';
                                    $content .= '<td class="text-center">'.$product['dosage_name'].'</td>';
                                    $content .= '<td class="text-center">'.$product['category_name'].'</td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No product available.</span></h3>';

                }

                echo $content;

            } else if($type == 'summary-outofstock') {

                $query = "SELECT * FROM tbl_brand WHERE brand_qtyperpiece = 0";

                $sql = mysqli_query($connection, $query);

                $prod = "SELECT * FROM tbl_product WHERE product_qtyperpiece = 0";

                $sqlprod = mysqli_query($connection, $prod);

                if($sql->num_rows > 0 || $sqlprod->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Brand / Product</th>';
                                    $content .= '<th>Brand / Product Stock</th>';
                                    $content .= '<th>Brand / Product Expiration</th>';
                                    $content .= '<th>Type</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($brand = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$brand['brand_name'].'</td>';
                                    $content .= '<td>'.$brand['brand_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($brand['brand_expiration'])).' at '.date('g:i A', strtotime($brand['brand_expiration'])).'</td>';
                                    $content .= '<td><strong>Brand</strong></td>';
                                $content .= '</tr>';

                            }

                            while($prod = mysqli_fetch_assoc($sqlprod)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$prod['product_name'].'</td>';
                                    $content .= '<td>'.$prod['product_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($prod['product_expiration'])).' at '.date('g:i A', strtotime($prod['product_expiration'])).'</td>';
                                    $content .= '<td><strong>Product</strong></td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No Expired available.</span></h3>';

                }

                echo $content;

            } else if($type == 'summary-criticalstock') {

                $query = "SELECT * FROM tbl_brand WHERE brand_qtyperpiece <= 100";

                $sql = mysqli_query($connection, $query);

                $prod = "SELECT * FROM tbl_product WHERE product_qtyperpiece <= 100";

                $sqlprod = mysqli_query($connection, $prod);

                if($sql->num_rows > 0 || $sqlprod->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Brand / Product</th>';
                                    $content .= '<th>Brand / Product Stock</th>';
                                    $content .= '<th>Brand / Product Expiration</th>';
                                    $content .= '<th>Type</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($brand = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$brand['brand_name'].'</td>';
                                    $content .= '<td>'.$brand['brand_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($brand['brand_expiration'])).' at '.date('g:i A', strtotime($brand['brand_expiration'])).'</td>';
                                    $content .= '<td><strong>Brand</strong></td>';
                                $content .= '</tr>';

                            }

                            while($prod = mysqli_fetch_assoc($sqlprod)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$prod['product_name'].'</td>';
                                    $content .= '<td>'.$prod['product_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($prod['product_expiration'])).' at '.date('g:i A', strtotime($prod['product_expiration'])).'</td>';
                                    $content .= '<td><strong>Product</strong></td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No critical stock available.</span></h3>';

                }

                echo $content;

            } else if($type == 'summary-expiration') {

                $query = "SELECT * FROM tbl_brand WHERE brand_expiration < DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                $sql = mysqli_query($connection, $query);

                $prod = "SELECT * FROM tbl_product WHERE product_expiration < DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                $sqlprod = mysqli_query($connection, $prod);

                if($sql->num_rows > 0 || $sqlprod->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Brand / Product</th>';
                                    $content .= '<th>Brand / Product Stock</th>';
                                    $content .= '<th>Brand / Product Expiration</th>';
                                    $content .= '<th>Type</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($brand = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$brand['brand_name'].'</td>';
                                    $content .= '<td>'.$brand['brand_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($brand['brand_expiration'])).' at '.date('g:i A', strtotime($brand['brand_expiration'])).'</td>';
                                    $content .= '<td><strong>Brand</strong></td>';
                                $content .= '</tr>';

                            }

                            while($prod = mysqli_fetch_assoc($sqlprod)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$prod['product_name'].'</td>';
                                    $content .= '<td>'.$prod['product_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($prod['product_expiration'])).' at '.date('g:i A', strtotime($prod['product_expiration'])).'</td>';
                                    $content .= '<td><strong>Product</strong></td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No nearly expired available.</span></h3>';

                }

                echo $content;

            } else if($type == 'summary-expired') {

                $query = "SELECT * FROM tbl_brand WHERE brand_expiration = CURDATE()";

                $sql = mysqli_query($connection, $query);

                $prod = "SELECT * FROM tbl_product WHERE product_expiration = CURDATE()";

                $sqlprod = mysqli_query($connection, $prod);

                if($sql->num_rows > 0 || $sqlprod->num_rows > 0) {

                    $content = '<div class="table-responsive">';
                        $content .= '<table class="table">';
                            $content .= '<thead>';
                                $content .= '<tr>';
                                    $content .= '<th>Brand / Product</th>';
                                    $content .= '<th>Brand / Product Stock</th>';
                                    $content .= '<th>Brand / Product Expiration</th>';
                                    $content .= '<th>Type</th>';
                                $content .= '</tr>';
                            $content .= '</thead>';
                            $content .= '<tbody>';

                            while($brand = mysqli_fetch_assoc($sql)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$brand['brand_name'].'</td>';
                                    $content .= '<td>'.$brand['brand_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($brand['brand_expiration'])).' at '.date('g:i A', strtotime($brand['brand_expiration'])).'</td>';
                                    $content .= '<td><strong>Brand</strong></td>';
                                $content .= '</tr>';

                            }

                            while($prod = mysqli_fetch_assoc($sqlprod)) {

                                $content .= '<tr>';
                                    $content .= '<td>'.$prod['product_name'].'</td>';
                                    $content .= '<td>'.$prod['product_qtyperpiece'].'</td>';
                                    $content .= '<td>'.date('F, d Y', strtotime($prod['product_expiration'])).' at '.date('g:i A', strtotime($prod['product_expiration'])).'</td>';
                                    $content .= '<td><strong>Product</strong></td>';
                                $content .= '</tr>';

                            }

                            $content .= '</tbody>';
                        $content .= '</table>';
                    $content .= '</div>';

                } else {

                    $content = '<h3 class="mt0"><span class="label label-default">No expired available.</span></h3>';

                }

                echo $content;

            }

        } else {

            echo 'error';

        }

    } else {

        echo 'invalid';

    }

?>
