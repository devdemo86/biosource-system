<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['dateRange'])) {

            $date = explode(' - ', $_POST['dateRange']);

            $start = date('Y-m-d', strtotime($date[0]));

            $end = date('Y-m-d', strtotime($date[1]));

            $query = "SELECT * FROM tbl_transaction t INNER JOIN tbl_user u ON u.user_id = t.trans_cashier WHERE (DATE(t.trans_date) BETWEEN '".$start."' AND '".$end."')";

            $result = mysqli_query($connection, $query);

            $htmlcontent = "";

            while($row = mysqli_fetch_assoc($result)) {

                $htmlcontent .= "<tr>";

                    $htmlcontent .= '<td class="text-center">'.$row['trans_id'].'</td>';

                    $htmlcontent .= '<td><strong>P </strong>'.number_format($row['trans_price'], 2).'</td>';

                    $htmlcontent .= '<td>'.$row['trans_citizen'].'</td>';

                    $htmlcontent .= '<td>'.date('M d, Y', strtotime($row['trans_date'])).' <b>at</b> '.date('g:i A', strtotime($row['trans_date'])).'</td>';

                    $htmlcontent .= '<td>'.$row['user_fname'].' '.$row['user_mname'].' '.$row['user_lname'].'</td>';

                $htmlcontent .= "</tr>";

            }

            echo $htmlcontent;

        } else {

            echo "error";

        }

    } else {

        header("Location: ../login");

    }

?>
