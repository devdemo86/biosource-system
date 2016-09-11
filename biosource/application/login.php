<?php

    session_start();

    if(isset($_SESSION['type_id'])) {

        if((int) $_SESSION['type_id'] === 1) {

            header("Location: admin/admin-home");

        } else {

            header("Location: user/user-home");

        }

    } else {

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BIOSOURCE | Log in</title>
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/app.css">
    </head>
    <body class="body-login">
        <main class="wrap">
            <section class="form-section">
                <form class="form-login" autocomplete="off">
                    <div class="text-center">
                        <p><img src="../assets/images/company-logo.jpg" width="200" height="200" alt="Company Logo"></p>
                        <h3 class="form-title">
                            BIOSOURCE Drug Store
                        </h3>
                    </div>
                    <div class="form-input input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="form-user" placeholder="Username" class="focus form-control input-group" required="required">
                    </div>
                    <div class="form-input input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" placeholder="Password" name="form-pass" class="form-control input-group" required="required">
                    </div>
                    <p class="form-input">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign in</button>
                    </p>
                    <div class="alert alert-danger alert-dismissible form-alert" role="alert">
                        <strong>No Match Found!</strong>
                        <span class="help-block"></span>
                        <p>
                            Better check credentials, you're not entering the proper credentials. Please sign in properly.
                        </p>
                    </div>
                </form>
            </section>
        </main>
        <script src="../assets/js/jquery-3.1.0.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/app.js"></script>
    </body>
</html>
<?php } ?>
