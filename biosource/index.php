<?php

    $login = 'application/login.php';

    if(file_exists($login)) {

        header("Location: ".str_replace('.php', '', $login));

    } else {

        header("Location: application/errors/404");

    }

?>
