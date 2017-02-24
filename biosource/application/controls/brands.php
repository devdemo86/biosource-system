<?php

    session_start();

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $brand = "SELECT * FROM tbl_brand b INNER JOIN tbl_generic g ON b.generic_code = g.generic_code INNER JOIN tbl_category c ON ";
        $brand .= "b.category_code = c.category_code INNER JOIN tbl_dosage d ON b.dosage_code = d.dosage_code GROUP BY b.brand_id ORDER BY b.brand_name ASC";

        $sqlbrand = mysqli_query($connection, $brand);

        while($item = mysqli_fetch_assoc($sqlbrand)) {

            $content = '';
            $content .= '<tr>';
                $content .= '<td>'.$item['brand_name'].'</td>';
                $content .= '<td>'.$item['generic_name'].'</td>';
                $content .= '<td>'.$item['category_name'].'</td>';
                $content .= '<td>'.$item['dosage_name'].'</td>';
                $content .= '<td class="text-center">'.date('F d, Y', strtotime($item['brand_expiration'])).'</td>';
                $content .= '<td class="text-center">'.$item['brand_qtyperbox'].'</td>';
                $content .= '<td class="text-center">'.$item['brand_qtyperpiece'].'</td>';
                $content .= '<td class="text-center">'.$item['brand_priceperbox'].'</td>';
                $content .= '<td class="text-center">'.$item['brand_priceperpiece'].'</td>';
                $content .= '<td class="text-center">';
                    $content .= '<a href="#prod-update" class="btn btn-primary btn-sm" data-id="'.$item['brand_id'].'">';
                        $content .= '<span class="glyphicon glyphicon-pencil"></span> &nbsp;Update';
                    $content .= '</a>';
                    $content .= '&nbsp;';
                    $content .= '<a href="#prod-delete" class="btn btn-danger btn-sm" data-id="'.$item['brand_id'].'">';
                        $content .= '<span class="glyphicon glyphicon-trash"></span> &nbsp;Delete';
                    $content .= '</a>';
                $content .= '</td>';
            $content .= '</tr>';

            echo $content;

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
