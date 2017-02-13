<?php

    if(isset($_SESSION['type_id']) || isset($_POST['id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $querybrnd = "SELECT * FROM tbl_brand p INNER JOIN tbl_generic g ON p.generic_code = g.generic_code INNER JOIN tbl_dosage d ";
        $querybrnd .= "ON p.dosage_code = d.dosage_code ORDER BY p.brand_name ASC";

        $sqlbrnd = mysqli_query($connection, $querybrnd);

        if($sqlbrnd->num_rows > 0) {

            while ($brndrow = mysqli_fetch_assoc($sqlbrnd)) {

                $content = '<tr data-id="brand">';
                    $content .= '<td class="purchase-name">'.$brndrow['brand_name'].'</td>';
                    $content .= '<td>'.$brndrow['generic_name'].'</td>';
                    $content .= '<td class="text-center">'.$brndrow['dosage_name'].'</td>';
                    $content .= '<td class="text-center">'.date('F d, Y', strtotime($brndrow['brand_expiration'])).'</td>';
                    $content .= '<td class="text-center"><strong>P </strong>'.number_format($brndrow['brand_priceperpiece'], 2).'</td>';
                    $content .= '<td class="text-center">'.$brndrow['brand_qtyperpiece'].'</td>';
                    $content .= '<td class="text-center"><strong>P </strong>'.number_format($brndrow['brand_priceperbox'], 2).'</td>';
                    $content .= '<td class="text-center">'.$brndrow['brand_qtyperbox'].'</td>';
                    $content .= '<td>';
                        $content .= '<button type="button" data-id="'.$brndrow['brand_id'].'" class="btn btn-block btn-primary btn-purchase">';
                        $content .= '<span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;Add to Cart</button>';
                    $content .= '</td>';
                $content .= '</tr>';

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="9"><h3 class="mt0"><span class="label label-default">No brand available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
