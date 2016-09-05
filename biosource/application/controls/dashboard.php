<?php

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $content = '';
        $content .= '<div class="col-lg-12">';
            $content .= '<div class="col-lg-3">';
                $content .= '<div class="list-group">';
                    $content .= '<a href="#summary-accounts" class="list-group-item">';
                        $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                        $account = "SELECT COUNT(*) FROM tbl_user";

                        $sqlacc = mysqli_query($connection, $account);

                        $user = mysqli_fetch_row($sqlacc)[0];

                        $content .= $user;

                        $content .= '</h1>';
                        $content .= '<h4 class="text-center list-group-item-heading">All Registered Account';

                        $content .= $user > 1 ? 's' : '';

                        $content .= '</h4>';
                        $content .= '<p class="text-center list-group-item-text">This are the summary of all the account in this system.</p>';
                        $content .= '<p class="text-center"><strong>Status: &nbsp;</strong>';
                        $content .= '<span class="label label-success">Active</span> &nbsp;<span class="label label-danger">Inactive</span></p>';
                    $content .= '</a>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-suppliers" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $supply = "SELECT COUNT(*) FROM tbl_supplier";

                    $sqlsup = mysqli_query($connection, $supply);

                    $supplier = mysqli_fetch_row($sqlsup)[0];

                    $content .= $supplier;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">All Registered Supplier';

                    $content .= $supplier > 1 ? 's' : '';

                    $content .= '</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the summary of all the supplier in this system.</p>';
                    $content .= '<p class="text-center"><strong>Status: &nbsp;</strong>';
                    $content .= '<span class="label label-success">Active</span> &nbsp;<span class="label label-danger">Inactive</span></p>';
                $content .= '</a>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-brands" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $brand = "SELECT COUNT(*) FROM tbl_brand";

                    $sqlbrnd = mysqli_query($connection, $brand);

                    $brnd = mysqli_fetch_row($sqlbrnd)[0];

                    $content .= $brnd;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">All Registered Brand';

                    $content .= $brnd > 1 ? 's' : '';

                    $content .= '</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the summary of all the brand in this system.</p>';
                    $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                    $content .= '<span class="label label-success">Brand</span></p>';
                $content .= '</a>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-products" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $product = "SELECT COUNT(*) FROM tbl_product";

                    $sqlprod = mysqli_query($connection, $product);

                    $prod = mysqli_fetch_row($sqlprod)[0];

                    $content .= $prod;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">All Registered Product';

                    $content .= $prod > 1 ? 's' : '';

                    $content .= '</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the summary of all the product in this system.</p>';
                    $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                    $content .= '<span class="label label-success">Products</span></p>';
                $content .= '</a>';
            $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-lg-12">';
            $content .= '<div class="col-lg-3">';
                $content .= '<div class="list-group">';
                    $content .= '<a href="#summary-outofstock" class="list-group-item">';
                        $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                        $outbrand = "SELECT COUNT(brand_qtyperpiece) FROM tbl_brand WHERE brand_qtyperpiece = 0";

                        $outbrandtotal = mysqli_query($connection, $outbrand);

                        $brandsum = mysqli_fetch_row($outbrandtotal)[0];

                        $outprod = "SELECT COUNT(product_qtyperpiece) FROM tbl_product WHERE product_qtyperpiece = 0";

                        $outprodtotal = mysqli_query($connection, $outprod);

                        $prodsum = mysqli_fetch_row($outprodtotal)[0];

                        $content .= $brandsum + $prodsum;

                        $content .= '</h1>';
                        $content .= '<h4 class="text-center list-group-item-heading">Out of Stock</h4>';
                        $content .= '<p class="text-center list-group-item-text">This are the total of all the out of stock item in this system.</p>';
                        $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                        $content .= '<span class="label label-danger">Out of Stock</span></p>';
                    $content .= '</a>';
                $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-criticalstock" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $critbrand = "SELECT COUNT(brand_qtyperpiece) FROM tbl_brand WHERE brand_qtyperpiece <= 100";

                    $critbrandtotal = mysqli_query($connection, $critbrand);

                    $brandcrit = mysqli_fetch_row($critbrandtotal)[0];

                    $critprod = "SELECT COUNT(product_qtyperpiece) FROM tbl_product WHERE product_qtyperpiece <= 100";

                    $critprodtotal = mysqli_query($connection, $critprod);

                    $prodcrit = mysqli_fetch_row($critprodtotal)[0];

                    $content .= $brandcrit + $prodcrit;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">Critical Stock</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the total of all the critical stock in this system.</p>';
                    $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                    $content .= '<span class="label label-danger">Critical Stock</span></p>';
                $content .= '</a>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-expiration" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $nearlybrand = "SELECT COUNT(brand_expiration) FROM tbl_brand WHERE brand_expiration < DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                    $expirebrand = mysqli_query($connection, $nearlybrand);

                    $nearlydatebrand = mysqli_fetch_row($expirebrand)[0];

                    $nearlyprod = "SELECT COUNT(product_expiration) FROM tbl_product WHERE product_expiration < DATE_ADD(CURDATE(), INTERVAL 3 MONTH)";

                    $expireprod = mysqli_query($connection, $nearlyprod);

                    $nearlydateprod = mysqli_fetch_row($expireprod)[0];

                    $content .= $nearlydatebrand + $nearlydateprod;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">Nearly Expired</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the total of all the nearly expired item in this system.</p>';
                    $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                    $content .= '<span class="label label-danger">Nearly Expired</span></p>';
                $content .= '</a>';
            $content .= '</div>';
            $content .= '<div class="col-lg-3">';
                $content .= '<a href="#summary-expired" class="list-group-item">';
                    $content .= '<h1 class="text-center accounts-number mt0 mb0">';

                    $expiredbrnd = "SELECT COUNT(brand_expiration) FROM tbl_brand WHERE brand_expiration = CURDATE()";

                    $expiredall = mysqli_query($connection, $expiredbrnd);

                    $expiredallbrnd = mysqli_fetch_row($expiredall)[0];

                    $expiredprod = "SELECT COUNT(product_expiration) FROM tbl_product WHERE product_expiration = CURDATE()";

                    $expiredallprod = mysqli_query($connection, $expiredprod);

                    $exactexpired = mysqli_fetch_row($expiredallprod)[0];

                    $content .= $expiredallbrnd + $exactexpired;

                    $content .= '</h1>';
                    $content .= '<h4 class="text-center list-group-item-heading">Total Expired Today</h4>';
                    $content .= '<p class="text-center list-group-item-text">This are the total of all expired item in this system.</p>';
                    $content .= '<p class="text-center"><strong>Type: &nbsp;</strong>';
                    $content .= '<span class="label label-success">Brand</span> &nbsp;<span class="label label-success">Product</span></p>';
                $content .= '</a>';
            $content .= '</div>';
        $content .= '</div>';

        echo $content;

    } else {

        header("Location: ../login");

    }

?>
