<?php session_start(); if(isset($_SESSION['type_id'])): ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Company Name | File 404</title>
        <link rel="shortcut icon" href="../../favicon.ico">
        <style media="screen">
            body {
                background: #efefef;
                font-size: 14px;
                font-family: "Source Sans Pro", sans-serif;
            }
            ::selection {
                background: #fb4242;
                color: #fff;
            }
            .wrap {
                width: 100%;
                height: auto;
                padding-top: 3em;
            }
            .error-section {
                max-width: 1200px;
                width: 90%;
                height: auto;
                margin: 0 auto;
                padding: 15px 15px;
                border: 1px solid;
                border-color: #e5e6e9 #dfe0e4 #d0d1d5;
                border-radius: 3px;
                background: #fff;
            }
            .error-heading {
                margin: 0;
                padding-bottom: 15px;
                border-bottom: 1px solid #ccc;
                color: #444;
                font-size: 250%;
            }
            .error-message {
                color: #333;
                font-size: 116%;
                letter-spacing: .5px;
            }
        </style>
    </head>
    <body>
        <main class="wrap">
            <section class="error-section">
                <h1 class="error-heading">File Not Found | File 404</h1>
                <p class="error-message">
                    Please check the file you we're looking maybe it is not available or maybe it is removed and move to the other directory.
                </p>
            </section>
        </main>
    </body>
</html>
<?php else: ?>
    <?php header("Location: ../login"); ?>
<?php endif; ?>
