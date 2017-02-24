<?php

    if(isset($_SESSION['type_id']) && $_SESSION['type_id'] == 1) {

        require_once('../controls/config.php');

        require_once('../controls/connection.php');

        require_once('../controls/class/BCGFontFile.php');

        require_once('../controls/class/BCGColor.php');

        require_once('../controls/class/BCGDrawing.php');

        require_once('../controls/class/BCGcode39.barcode.php');

        $font = new BCGFontFile('../controls/font/Arial.ttf', 18);

        $text = isset($_GET['barcode']) ? $_GET['barcode'] : 'INVALID BARCODE';

        $color_black = new BCGColor(0, 0, 0);

        $color_white = new BCGColor(255, 255, 255);

        $drawException = null;

        try {

            $code = new BCGcode39();

            $code->setScale(2);

            $code->setThickness(30);

            $code->setForegroundColor($color_black);

            $code->setBackgroundColor($color_white);

            $code->setFont($font);

            $code->parse($text);

        } catch(Exception $exception) {

            $drawException = $exception;

        }

        $drawing = new BCGDrawing('', $color_white);

        if($drawException) {

            $drawing->drawException($drawException);

        } else {

            $drawing->setBarcode($code);

            $drawing->draw();

        }

        header('Content-Type: image/png');

        header('Content-Disposition: inline; filename="barcode.png"');

        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    } else {

        header('Location: ../login');

    }

?>
