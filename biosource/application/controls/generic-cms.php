<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        $generic = "SELECT * FROM tbl_generic ORDER BY generic_id ASC";

        $sqlgen = mysqli_query($connection, $generic);

        while($gen = mysqli_fetch_assoc($sqlgen)) {

            echo '<li>'.$gen['generic_name'].'

                    <span class="pull-right">

                        <button type="button" class="btn btn-danger btn-remove-cms btn-xs" data-type="generic" data-code="'.$gen['generic_id'].'">

                            <span class="glyphicon glyphicon-trash"></span> Delete

                        </button>

                    </span>

                </li>';

        }

    } else {

        header("Location: ../errors/dberror");

    }

?>
