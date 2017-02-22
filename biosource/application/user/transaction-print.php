<?php session_start(); if(isset($_SESSION['type_id'])): ?>
<?php date_default_timezone_set('Asia/Manila'); ?>
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
        <main class="receipt">
            <div class="text-center btn-print-container print-css">
                <button type="button" class="btn btn-primary btn-print-receipt"><span class="glyphicon glyphicon-print"></span> &nbsp;Print Receipt</button>
                <button type="button" class="btn btn-primary btn-done-trans"><span class="glyphicon glyphicon-check"></span> &nbsp;Done</button>
            </div>
            <h4 class="text-center">BIOSOURCE DRUGSTORE &amp; GEN. MERCHANDISE</h4>
            <p class="text-center">579 A. Mabini Street Sangandaan Plaza, Caloocan City</p>
            <p class="text-center">ESMERALDA B. CUA, Proprietress</p>
            <p class="text-center">VAT REG: 158-912-058-002</p>
            <p class="text-center">S / N.: FJ70001966</p>
            <p class="text-center">BIR Permit No.: 027-05-27-04-00047</p>
            <p class="text-center">Cashier: <?php echo $_SESSION['user_fname']; ?></p>
            <div class="receipt-content">
                <div class="border">
                    <div class="border">
                        <div class="receipt-date-or">
                            <div class="clearfix">
                                <span class="pull-left"><?php echo date('m/d/Y h:i: A'); ?></span>
                                <span class="pull-right">OR# <?php echo $_GET['transid']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="help-block"></span>
            <div class="clearfix">
                <p>No. of item(s)</p>
                <?php require_once('../controls/transaction-print-details.php'); ?>
            </div>
            <div class="receipt-footer">
                <p>Sold to:</p>
                <p>Address:</p>
                <p>TIN:</p>
                <p>Business Style:</p>
                <p class="text-center thank-you">Thank You! Come again.</p>
                <p class="text-center"><strong>***</strong> This is serve as your OFFICIAL RECEIPT <strong>***</strong></p>
                <p class="text-center">Thesis System of City of Malabon University</p>
                <p class="text-center">Maya-maya cor. Pampano St., Dagat-Dagatan, Malabon City 1470, Philippines</p>
                <p class="text-center">THIS INVOICE / RECEIPT SHALL BE VALID FOR FIVE (5) YEAR FROM THE DATE OF THE PERMIT TO USE.</p>
            </div>
        </main>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/jquery-3.1.0.min.js"></script>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/app.js"></script>
    </body>
</html>
<?php else: ?>
    <?php header("Location: ../login"); ?>
<?php endif; ?>
