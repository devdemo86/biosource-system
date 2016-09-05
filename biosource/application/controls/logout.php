<?php

    session_start();

    $destroy = session_destroy();

    if($destroy) {

        header("Location: ../login");

    } else {

        header("Location: ../errors/sessionerror");

    }

?>
