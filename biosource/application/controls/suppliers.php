<?php

    if(isset($_SESSION['type_id']) || isset($_POST['id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $id = isset($_POST['id']) ? $_POST['id'] : 1;

        $query = "SELECT * FROM tbl_supplier WHERE supplier_status = ".$id;

        $sql = mysqli_query($connection, $query);

        if($sql->num_rows > 0) {

            $counter = 1;

            while($row = mysqli_fetch_assoc($sql)) {

                $remarks = (int) $row['supplier_status'] === 1 ? '-success">Active' : '-danger">Inactive';

                $content = '<tr>';
                    $content .= '<td>'.$counter.'</td>';
                    $content .= '<td>'.$row['supplier_name'].'</td>';
                    $content .= '<td>'.$row['supplier_contact'].'</td>';
                    $content .= '<td class="address">'.$row['supplier_address'].'</td>';
                    $content .= '<td>'.date('F d, Y g:i A', strtotime($row['supplier_date'])).'</td>';
                    $content .= '<td><h4 class="text-center"><span class="label label'.$remarks.'</span></h4></td>';

                    if((int) $id === 1) {

                        $content .= '<td class="text-center">
                                        <a href="#update" id="'.$row['supplier_id'].'" class="btn btn-primary" data-code="suppliers">
                                            <span>Update &nbsp;<span class="glyphicon glyphicon-pencil"></span></span>
                                        </a>
                                        <a href="#delete" id="'.$row['supplier_id'].'" class="btn btn-danger" data-code="suppliers">
                                            <span>Remove &nbsp;<span class="glyphicon glyphicon-trash"></span></span>
                                        </a>
                                    </td>';

                    }

                $content .= '</tr>';

                $counter++;

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="7"><h3 class="mt0"><span class="label label-default">No supplier available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
