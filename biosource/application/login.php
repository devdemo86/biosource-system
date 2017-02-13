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
        <link rel="shortcut icon" href="../favicon.png">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/app.css">
    </head>
    <body class="body-login">
        <main class="wrap">
            <h3 class="system-title">
                POS with Inventory Management System
            </h3>
            <section class="form-section">
                <form class="form-login" autocomplete="off">
                    <div class="form-group">
                        <div class="text-center">
                            <p class="company-logo"><img src="../assets/images/company-logo.jpg" alt="Company Logo"></p>
                        </div>
                    </div>
                    <div class="form-input input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="form-user" placeholder="Username" class="focus form-control input-group" required="required">
                    </div>
                    <div class="form-input input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" placeholder="Password" name="form-pass" class="form-control input-group" required="required">
                    </div>
                    <p class="form-input">
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </p>
                    <p class="text-center"><a href="#forgot-password">Forgot Password?</a></p>
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
        <div class="forgot-password-modal modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form class="modal-content forgot-password-form">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-white">Forgot Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="forgot-password">Username:</label>
                            <input type="text" name="username-password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="forgot-password">New Password:</label>
                            <input type="password" name="forgot-password" class="form-control" placeholder="New Password">
                        </div>
                        <div>
                            <label for="forgot-password">Confirm Password:</label>
                            <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="alert alert-danger alert-login" style="margin-bottom:0;">
                            <p class="error-message"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="../assets/js/jquery-3.1.0.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/app.js"></script>
    </body>
</html>
<?php } ?>
