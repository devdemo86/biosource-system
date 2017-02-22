<?php

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT * FROM tbl_transaction WHERE trans_cashier = ".$_SESSION['user_id']." AND DATE(trans_date) = CURDATE() AND is_finish = 0";

        $result = mysqli_query($connection, $query);

        $html = '';

        $affected = array();

        $total = 0;

        $cash = 0;

        if($result && $result->num_rows > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                array_push($affected, $row['trans_id']);

                $cash = $row['trans_price'];

                $idsearch = $row['trans_type'] == 'tbl_product' ? 'product' : 'brand';

                $queryinner = "SELECT * FROM ".$row['trans_type']." WHERE ".$idsearch."_id = ".$row['item_id'];

                $queryinnerresult = mysqli_query($connection, $queryinner);

                $resultassoc = mysqli_fetch_assoc($queryinnerresult);

                $piece = $resultassoc[$idsearch.'_priceperpiece'] * $row['trans_qtypiece'];

                $box = $resultassoc[$idsearch.'_priceperbox'] * $row['trans_qtybox'];

                $total += $piece + $box;

                $html .= "<div class=\"clearfix\">";

                    $html .= "<span><strong>".$resultassoc[$idsearch.'_name']."</strong></span>";

                    $html .= "<div class=\"clearfix\">";

                        $html .= "<span class=\"pull-left\">Piece: <strong>P </strong>".number_format($resultassoc[$idsearch.'_priceperpiece'], 2)." @ ".$row['trans_qtypiece']."</span>";

                        $html .= "<span class=\"pull-right\">".number_format($piece, 2)."</span>";

                    $html .= "</div>";

                    $html .= "<div class=\"clearfix\">";

                        $html .= "<span class=\"pull-left\">Box: <strong>P </strong>".number_format($resultassoc[$idsearch.'_priceperbox'], 2)." @ ".$row['trans_qtybox']."</span>";

                        $html .= "<span class=\"pull-right\">".number_format($box, 2)."</span>";

                    $html .= "</div>";

                $html .= "</div>";

                $html .= "<span class=\"help-block\"></span>";

            }

            $html .= '<span class="trans-id" data-transaction-affted="'.(implode("|", $affected)).'"></span>';

            $html .= '<p class="clearfix">';
                $html .= '<span class="pull-left">Total Amount Due:</span>';
                $html .= '<span class="pull-right"><strong>P</strong> <span class="total-amount-due">'.number_format($total, 2).'</span></span>';
            $html .= '</p>';
            $html .= '<div class="clearfix">';
                $html .= '<div class="border pull-right"></div>';
            $html .= '</div>';
            $html .= '<p class="clearfix">';
                $html .= '<span class="pull-left">Cash Tender:</span>';
                $html .= '<span class="pull-right" style="border-bottom:2px solid #8c8c8c;"><strong>P</strong> <span class="amount">'.number_format($cash, 2).'</span></span>';
            $html .= '</p>';
            $html .= '<p class="clearfix">';
                $html .= '<span class="pull-left">Change:</span>';
                $html .= '<span class="pull-right"><strong>P</strong> <span class="amount-change">'.number_format(($cash - $total), 2).'</span></span>';
            $html .= '</p>';

            echo $html;

        } else {

            header("Location: ../user/user-home");

        }

    } else {

        header("Location: ../login");

    }

?>
