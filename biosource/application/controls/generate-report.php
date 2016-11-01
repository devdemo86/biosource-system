<?php

    error_reporting(0);

    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT * FROM tbl_transaction INNER JOIN tbl_user ON tbl_user.user_id = tbl_transaction.trans_cashier";

        if(isset($_POST['datacode'])) {

            if($_POST['datacode'] !== 'all') {

                $query = "SELECT *, SUM(trans_price) AS final_price FROM  tbl_transaction INNER JOIN tbl_user ON tbl_user.user_id = tbl_transaction.trans_cashier WHERE trans_date >= DATE_FORMAT(trans_date,'%Y-%m-01') GROUP BY DATE(trans_date), trans_cashier";

            } else {

                $query = "SELECT * FROM tbl_transaction INNER JOIN tbl_user ON tbl_user.user_id = tbl_transaction.trans_cashier";

            }

        }

        $sql = mysqli_query($connection, $query);

        if($sql->num_rows > 0) {

            while($row = mysqli_fetch_assoc($sql)) {

                $price = (isset($_POST['datacode']) && $_POST['datacode'] !== 'all') ? $row['final_price'] : $row['trans_price'];

                $content = '';
                $content .= '<tr>';
                    $content .= '<td class="text-center">'.$row['trans_id'].'</td>';
                    $content .= '<td><strong>P </strong>'.number_format($price, 2).'</td>';
                    $content .= '<td>'.$row['trans_citizen'].'</td>';
                    $content .= '<td>'.date('M d, Y', strtotime($row['trans_date'])).' <b>at</b> '.date('g:i A', strtotime($row['trans_date'])).'</td>';
                    $content .= '<td>'.$row['user_fname'].' '.$row['user_mname'].' '.$row['user_lname'].'</td>';
                $content .= '</tr>';

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="5"><h3 class="mt0"><span class="label label-default">No transaction available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
