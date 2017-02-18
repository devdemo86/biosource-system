<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['searchId'])) {

            $id = $_POST['searchId'][0]['value'];

            $type = $_POST['searchType'];

            $query = "SELECT * FROM tbl_".$type." t INNER JOIN tbl_generic g ON t.generic_code = g.generic_code INNER JOIN tbl_category c ON ";
            $query .= "t.category_code = c.category_code INNER JOIN tbl_dosage d ON t.dosage_code = d.dosage_code WHERE ".$type."_name ";
            $query .= "LIKE '%".$id."%' OR ".$type."_id LIKE '%".$id."%' OR c.category_name LIKE '%".$id."%' Or g.generic_name LIKE '%".$id."%' GROUP BY ".$type."_id ORDER BY t.".$type."_name ASC";

            $result = mysqli_query($connection, $query);

            if($result && (int) $result->num_rows != 0) {

                while($item = mysqli_fetch_assoc($result)) {

                    $content = '';
                    $content .= '<tr data-id="'.$type.'">';
                        $content .= '<td>'.$item[$type.'_name'].'</td>';
                        $content .= '<td>'.$item['category_name'].'</td>';
                        $content .= '<td>'.$item['generic_name'].'</td>';
                        $content .= '<td class="text-center">'.$item['dosage_name'].'</td>';
                        $content .= '<td class="text-center">'.date('F d, Y', strtotime($item[$type.'_expiration'])).'</td>';
                        $content .= '<td class="text-center">'.$item[$type.'_qtyperpiece'].'</td>';
                        $content .= '<td class="text-center">'.$item[$type.'_qtyperbox'].'</td>';
                        $content .= '<td class="text-center">'.$item[$type.'_priceperpiece'].'</td>';
                        $content .= '<td class="text-center">'.$item[$type.'_priceperbox'].'</td>';
                        $content .= '<td>';
                            $content .= '<button type="button" data-id="'.$item[$type.'_id'].'" class="btn btn-block btn-primary btn-purchase">';
                            $content .= '<span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;Add to Cart</button>';
                        $content .= '</td>';
                    $content .= '</tr>';

                    echo $content;

                }

            } else {

                echo 'zero';

            }

        } else {

            echo 'invalid';

        }

    } else {

        header("Location: ../login");

    }

?>
