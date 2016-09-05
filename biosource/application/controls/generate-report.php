<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT * FROM tbl_transaction";

        $sql = mysqli_query($connection, $query);

        if($sql->num_rows > 0) {

            while($row = mysqli_fetch_assoc($sql)) {

                $content = '';
                $content .= '<tr>';
                    $content .= '<td class="text-center">'.$row['trans_id'].'</td>';
                    $content .= '<td><strong>P </strong>'.number_format($row['trans_price'], 2).'</td>';
                    $content .= '<td>'.$row['trans_citizen'].'</td>';
                    $content .= '<td>'.$row['trans_date'].'</td>';
                    $content .= '<td>'.$row['trans_cashier'].'</td>';
                $content .= '</tr>';

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="5"><h3 class="mt0"><span class="label label-default">No transaction available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        // header("Location: ../login");

    }

?>
