<?php

    $connection = mysqli_connect($server, $username, $password, $database);

    if(mysqli_connect_errno()) {

        header("Location: pages/errors/dberror");

        die();

    }

    date_default_timezone_set($timezone);

?>
