<?php

    if(isset($_SESSION['type_id']) || isset($_POST['id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $queryprod = "SELECT * FROM tbl_product p INNER JOIN tbl_generic g ON p.generic_code = g.generic_code INNER JOIN tbl_dosage d ";
        $queryprod .= "ON p.dosage_code = d.dosage_code ORDER BY p.product_name ASC";

        $sqlprod = mysqli_query($connection, $queryprod);

        if($sqlprod->num_rows > 0) {

            while ($prodrow = mysqli_fetch_assoc($sqlprod)) {

                $content = '<tr data-id="product">';
                    $content .= '<td class="purchase-name">'.$prodrow['product_name'].'</td>';
                    $content .= '<td>'.$prodrow['generic_name'].'</td>';
                    $content .= '<td class="text-center">'.$prodrow['dosage_name'].'</td>';
                    $content .= '<td class="text-center">'.date('F d, Y', strtotime($prodrow['product_expiration'])).'</td>';
                    $content .= '<td class="text-center"><strong>P </strong> '.number_format($prodrow['product_priceperpiece'], 2).'</td>';
                    $content .= '<td class="text-center">'.$prodrow['product_qtyperpiece'].'</td>';
                    $content .= '<td class="text-center"><strong>P </strong> '.number_format($prodrow['product_priceperbox'], 2).'</td>';
                    $content .= '<td class="text-center">'.$prodrow['product_qtyperbox'].'</td>';
                    $content .= '<td>';
                        $content .= '<button type="button" data-id="'.$prodrow['product_id'].'" class="btn btn-block btn-primary btn-purchase">';
                        $content .= '<span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;Add to Cart</button>';
                    $content .= '</td>';
                $content .= '</tr>';

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="9"><h3 class="mt0"><span class="label label-default">No product available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
