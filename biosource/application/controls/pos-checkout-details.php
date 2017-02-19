<?php

    if(isset($_SESSION['type_id']) && (int) $_SESSION['type_id'] === 2) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $query = "SELECT * FROM tbl_checkout";

        $sql = mysqli_query($connection, $query);

        if($sql->num_rows > 0) {

            $sumpiece = 0;

            $sumpieceprice = 0;

            $sumbox = 0;

            $sumboxprice = 0;

            $totalexpense = 0;

            while($row = mysqli_fetch_assoc($sql)) {

                $content = '';
                $content .= '<tr data-piece="'.$row['checkout_qtypiece'].'" data-box="'.$row['checkout_qtybox'].'">';
                    $content .= '<td class="text-center">'.$row['checkout_id'].'</td>';

                        $tbl = $row['checkout_type'] === 'tbl_brand' ? 'brand_' : 'product_';

                        $queryitem = "SELECT ".$tbl."name, ".$tbl."priceperpiece, ".$tbl."priceperbox FROM ".$row['checkout_type']." WHERE ".$tbl."id = ".$row['item_id'];

                        $sqlitem = mysqli_query($connection, $queryitem);

                        if((int) $sqlitem->num_rows > 0) {

                            $item = mysqli_fetch_assoc($sqlitem);

                            $sumpiece += $row['checkout_qtypiece'];

                            $sumpieceprice += $item[$tbl.'priceperpiece'];

                            $sumbox += $row['checkout_qtybox'];

                            $sumboxprice += $item[$tbl.'priceperbox'];

                            $content .= '<td>'.$item[$tbl.'name'].'</td>';
                            $content .= '<td class="text-center">'.$row['checkout_qtypiece'].'</td>';
                            $content .= '<td class="text-center"><strong>P </strong>'.number_format($item[$tbl.'priceperpiece'], 2).'</td>';
                            $content .= '<td class="text-center">'.$row['checkout_qtybox'].'</td>';
                            $content .= '<td class="text-center"><strong>P </strong>'.number_format($item[$tbl.'priceperbox'], 2).'</td>';

                        }

                    $totalprice = ($row['checkout_qtypiece'] * $item[$tbl.'priceperpiece']) + ($row['checkout_qtybox'] * $item[$tbl.'priceperbox']);

                    $totalexpense = $totalprice;

                    $content .= '<td><strong>P</strong> '.number_format($totalprice, 2).'</td>';
                    $content .= '<td>'.date('M d, Y', strtotime($row['checkout_date'])).' <strong>at</strong> '.date('g:i:s A', strtotime($row['checkout_date'])).'</td>';

                    $queryitem = "SELECT user_fname FROM tbl_user WHERE user_id = ".$row['user_id'];

                    $cashier = mysqli_query($connection, $queryitem);

                    if((int) $cashier->num_rows > 0) {

                        $user = mysqli_fetch_assoc($cashier);

                        $content .= '<td>'.$user['user_fname'].'</td>';

                    }

                    $content .= '<td class="text-center">';
                        $content .= '<button type="button" data-id="'.$row['checkout_id'].'" class="btn btn-danger checkout-delete">';
                            $content .= '<span class="glyphicon glyphicon-trash"></span>';
                        $content .= '</button>';
                    $content .= '</td>';
                $content .= '</tr>';

                echo $content;

            }

            echo '<tr>
                    <td></td>
                    <td colspan="4"></td>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td><strong>P <span class="total-price">'.number_format($totalexpense, 2).'</span></strong></td>
                    <td>'.date('M d, Y').' <strong>at</strong> '.date('g:i:s A').'</td>
                    <td><span class="cashier">'.$_SESSION['user_fname'].'</span></td>
                    <td role="to-hide"></td>
                </tr>';

        } else {

            $content = '<tr class="zero"><td colspan="10"><h3 class="mt0"><span class="label label-default">No checkout available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
