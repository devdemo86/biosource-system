<?php

    if(isset($_POST['ajax'])) {

        session_start();

    }

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $prod = "SELECT * FROM tbl_product p INNER JOIN tbl_generic g ON p.generic_code = g.generic_code INNER JOIN tbl_category c ON p.category_code = c.category_code";
        $prod .= " INNER JOIN tbl_dosage d ON p.dosage_code = d.dosage_code ORDER BY p.product_name ASC";

        $sqlprod = mysqli_query($connection, $prod);

        while($item = mysqli_fetch_assoc($sqlprod)) {

            $content = '';
            $content .= '<tr>';
                $content .= '<td>'.$item['product_name'].'</td>';
                $content .= '<td>'.$item['generic_name'].'</td>';
                $content .= '<td>'.$item['category_name'].'</td>';
                $content .= '<td>'.$item['dosage_name'].'</td>';
                $content .= '<td class="text-center">'.date('F d, Y', strtotime($item['product_expiration'])).'</td>';
                $content .= '<td class="text-center">'.$item['product_qtyperbox'].'</td>';
                $content .= '<td class="text-center">'.$item['product_qtyperpiece'].'</td>';
                $content .= '<td class="text-center">'.$item['product_priceperbox'].'</td>';
                $content .= '<td class="text-center">'.$item['product_priceperpiece'].'</td>';
                $content .= '<td class="text-center">';
                    $content .= '<a href="#prod-update" class="btn btn-primary" data-id="'.$item['product_id'].'">';
                        $content .= '<span class="glyphicon glyphicon-pencil"></span> &nbsp;Update';
                    $content .= '</a>';
                    $content .= '&nbsp;';
                    $content .= '<a href="#prod-delete" class="btn btn-danger" data-id="'.$item['product_id'].'">';
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
