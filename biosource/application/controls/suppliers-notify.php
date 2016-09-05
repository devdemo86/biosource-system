<?php
    session_start();

    if(isset($_SESSION['type_id'])) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        if(isset($_POST['send'])) {

            $to = $_POST['send'][0]['value'];

            $message = $_POST['send'][1]['value'];

            $subject = "Notify Supplier for Ordering";

            $headers = 'From: BioSource Drug Store'."\r\n" .
                        'Content-type: text/html; charset=iso-8859-1'."\r\n".
                        'Reply-To: webmaster@example.com'."\r\n".
                        'X-Mailer: PHP/'.phpversion();

            $send = mail($to, $subject, $message, $headers);

            if($send) {

                echo 'success';

            } else {

                echo 'id-error';

            }

        } else {

            echo 'id-error';

        }

    } else {

        echo 'invalid';

    }

?>
