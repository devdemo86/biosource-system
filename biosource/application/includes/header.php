<?php if(isset($_SESSION['type_id'])): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BIOSOURCE Drug Store</title>
        <link rel="stylesheet" href="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/css/print.css">
        <link rel="stylesheet" href="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/css/app.css">
        <link rel="shortcut icon" href="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/images/company-logo.jpg">
    </head>
    <body>
        <header class="site-header">
            <nav class="nav navbar-inverse navbar-fixed-top">
                <div class="site-nav container clearfix">
                    <p class="pull-left">
                        <a href="../login">
                            <span>BIOSOURCE</span>
                        </a>
                    </p>
                    <div class="site-dropdown pull-right">
                        <p>
                            <a href="#settings">Welcome <?php echo $_SESSION['user_fname']; ?> &nbsp;<span class="caret"></span></a>
                        </p>
                        <div class="dropdown-container">
                            <ul class="dropdown-option">
                                <?php if($_SESSION['type_id'] == 1): ?>
                                <li><a href="#generate-barcode"><span class="glyphicon glyphicon-barcode"></span> &nbsp; Generate Barcode</a></li>
                                <?php endif; ?>
                                <li><a href="#changepass"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Change Password</a></li>
                                <li><a href="#logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <?php else: ?>
            <?php header("Location: ../login"); ?>
        <?php endif; ?>
