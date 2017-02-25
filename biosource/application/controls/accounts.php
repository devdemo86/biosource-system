<?php

    if(isset($_SESSION['type_id']) || isset($_POST['id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $id = isset($_POST['id']) ? $_POST['id'] : 1;

        $all = "SELECT * FROM tbl_user u INNER JOIN tbl_status s ON u.user_id = s.user_id INNER JOIN tbl_type t ON u.type_id = t.type_id WHERE s.status_remarks = ".$id;

        $sql = mysqli_query($connection, $all);

        if($sql->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($sql)) {

                $remarks = (int) $row['status_remarks'] === 1 ? '-success">Active' : '-danger">Inactive';

                $content = '<tr>';
                    $content .= '<td>'.$row['user_lname'].'</td>';
                    $content .= '<td>'.$row['user_fname'].'</td>';
                    $content .= '<td>'.$row['user_mname'].'</td>';
                    $content .= '<td>'.$row['user_address'].'</td>';
                    $content .= '<td>'.$row['status_contact'].'</td>';
                    $content .= '<td>'.$row['user_username'].'</td>';
                    $content .= '<td><h4 class="text-center"><span class="label label'.$remarks.'</span></h4></td>';

                    if((int) $id === 1) {

                        $content .= '<td class="text-center">
                                        <a href="#update" id="'.$row['user_id'].'" class="btn btn-primary btn-sm" data-code="accounts">
                                            <span>Update &nbsp;<span class="glyphicon glyphicon-pencil"></span></span>
                                        </a>
                                        <a href="#delete" id="'.$row['user_id'].'" class="btn btn-danger btn-sm" data-code="accounts">
                                            <span>Remove &nbsp;<span class="glyphicon glyphicon-trash"></span></span>
                                        </a>
                                    </td>';

                    }

                $content .= '</tr>';

                echo $content;

            }

        } else {

            $content = '<tr><td colspan="7"><h3 class="mt0"><span class="label label-default">No account available.</span></h3></td></tr>';

            echo $content;

        }

    } else {

        header("Location: ../login");

    }

?>
