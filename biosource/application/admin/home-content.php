<?php if(isset($_SESSION['type_id']) && (int) $_SESSION['status_remarks'] === 1): ?>
<main class="site-content container">
    <span class="help-block"></span>
    <p class="text-right time"></p>
    <span class="help-block"></span>
    <ul class="nav nav-tabs nav-justified admin-tabs">
        <li class="active"><a href="#"><i class="glyphicon glyphicon-dashboard"></i> &nbsp;Dashboard</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-plus"></i> &nbsp;Add</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-user"></i> &nbsp;Manage User</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list"></i> &nbsp;Inventory</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-user"></i> &nbsp;Suppliers</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> &nbsp;Generate Report</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-bell"></i> &nbsp;Notify Supplier</a></li>
    </ul>
    <span class="help-block"></span>
    <div class="panel panel-default mb10">
        <div class="panel-heading">
            <h3 class="panel-title admin-title">Dashboard</h3>
        </div>
        <div class="panel-body">
            <div class="dashboard">
                <div class="col-lg-12">
                    <div class="row">
                        <?php require_once('../controls/dashboard.php'); ?>
                    </div>
                </div>
            </div>
            <div class="add hidden">
                <ul class="nav nav-tabs nav-justified add-tabs">
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-barcode"></i> &nbsp;Branded</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-tag"></i> &nbsp;Generic</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> &nbsp;User</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> &nbsp;Supplier</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> &nbsp;CMS</a></li>
                </ul>
                <span class="help-block"></span>
                <div class="branded">
                    <form class="col-lg-12 form-add-product" autocomplete="off">
                        <div class="form-group">
                            <div class="clearfix row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <label for="product-name">Branded Name:</label>
                                            <input type="text" name="product-name" class="form-control" placeholder="Branded Name" required="required">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="product-name">Variant Name:</label>
                                            <select class="form-control" name="vartiant-name" required="required">
                                                <option selected="selected" disabled="disabled" value="">Available</option>
                                                <?php require('../controls/variant.php'); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-6">
                                <label for="generic-name">Generic Name:</label>
                                <select class="form-control" name="generic-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/generic.php'); ?>
                                </select>
                            </div>
                            <div class="no-padding-right col-lg-6">
                                <label for="generic-name">Dosage:</label>
                                <select class="form-control" name="dosage-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/dosage.php'); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-6">
                                <label for="category-name">Category Name:</label>
                                <select class="form-control" name="category-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/category.php'); ?>
                                </select>
                            </div>
                            <div class="no-padding col-lg-3">
                                <label for="quantity-box">Quantity (Box):</label>
                                <input type="number" name="prod-qtyperbox" placeholder="Box" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="quantity-piece">Quantity (Piece):</label>
                                <input type="number" name="prod-qtyperpiece" placeholder="Piece" class="form-control" required="required" min="1">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-4">
                                <label for="price-box">Price (Piece):</label>
                                <input type="number" name="prod-priceperpiece" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-4">
                                <label for="price-piece">Price (Box):</label>
                                <input type="number" name="prod-priceperbox" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-4">
                                <label for="expire-date">Expiration Date:</label>
                                <input type="date" name="prod-expiration" class="form-control" value="<?php echo date('Y-m-d'); ?>" required="required">
                            </div>
                        </div>
                        <div class="mb10 clearfix">
                            <div class="no-padding-left col-lg-3">
                                <label for="holding-cost">Holding Cost:</label>
                                <input type="number" name="prod-holdingcost" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="ordering-cost">Ordering Cost:</label>
                                <input type="number" name="prod-orderingcost" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="total-quantity">Total Quantity (Box):</label>
                                <input type="number" name="prod-qtyperbox" placeholder="Total" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="supplier">Supplier:</label>
                                <select class="form-control" name="supplier-account" required="required">
                                    <?php require('../controls/suppliers-contact.php'); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb10">
                            <div class="mb10">
                                <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                                    <strong>Well done!</strong> You have successfully added the product.
                                </div>
                                <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                                    <strong>Oooops!</strong> Change a few things up and try submitting again.
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <p class="pull-right mb0">
                                <button type="submit" class="btn btn-primary product-button-add">Submit</button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="generic hidden">
                    <form class="col-lg-12 form-add-brand" autocomplete="off">
                        <div class="form-group clearfix">
                            <div class="clearfix row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <label for="brand-name">Product Name:</label>
                                            <input type="text" name="brand-name" class="form-control" placeholder="Product Name" required="required">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="product-name">Variant Name:</label>
                                            <select class="form-control" name="vartiant-name" required="required">
                                                <option selected="selected" disabled="disabled" value="">Available</option>
                                                <?php require('../controls/variant.php'); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-6">
                                <label for="generic-name">Generic Name:</label>
                                <select class="form-control" name="generic-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/generic.php'); ?>
                                </select>
                            </div>
                            <div class="no-padding-right col-lg-6">
                                <label for="generic-name">Dosage:</label>
                                <select class="form-control" name="dosage-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/dosage.php'); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-6">
                                <label for="category-name">Category Name:</label>
                                <select class="form-control" name="category-code" required="required">
                                    <option selected="selected" disabled="disabled" value="">Available</option>
                                    <?php require('../controls/category.php'); ?>
                                </select>
                            </div>
                            <div class="no-padding col-lg-3">
                                <label for="quantity-box">Quantity (Box):</label>
                                <input type="number" name="brand-qtyperbox" placeholder="Box" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="quantity-piece">Quantity (Piece):</label>
                                <input type="number" name="brand-qtyperpiece" placeholder="Piece" class="form-control" required="required" min="1">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="no-padding-left col-lg-4">
                                <label for="price-box">Price (Piece):</label>
                                <input type="number" name="brand-priceperpiece" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-4">
                                <label for="price-piece">Price (Box):</label>
                                <input type="number" name="brand-priceperbox" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-4">
                                <label for="expire-date">Expiration Date:</label>
                                <input type="date" name="brand-expiration" class="form-control" value="<?php echo date('Y-m-d'); ?>" required="required">
                            </div>
                        </div>
                        <div class="mb10 clearfix">
                            <div class="no-padding-left col-lg-3">
                                <label for="holding-cost">Holding Cost:</label>
                                <input type="number" name="brand-holdingcost" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="ordering-cost">Ordering Cost:</label>
                                <input type="number" name="brand-orderingcost" placeholder="Php" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="total-quantity">Total Quantity (Box):</label>
                                <input type="number" name="brand-totalqtyperbox" placeholder="Total" class="form-control" required="required" min="1">
                            </div>
                            <div class="no-padding-right col-lg-3">
                                <label for="supplier">Supplier:</label>
                                <select class="form-control" name="brand-supplier-account" required="required">
                                    <?php require('../controls/suppliers-contact.php'); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb10">
                            <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                                <strong>Well done!</strong> You have successfully added the brand.
                            </div>
                            <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                                <strong>Oooops!</strong> Change a few things up and try submitting again.
                            </div>
                        </div>
                        <div class="clearfix">
                            <p class="pull-right mb0">
                                <button type="submit" class="btn btn-primary brand-button-add">Submit</button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="user hidden">
                    <form class="col-lg-12 form-add-user" autocomplete="off">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="no-padding-left col-lg-4">
                                        <div class="form-group">
                                            <label for="first-name">First Name:</label>
                                            <input type="text" name="user-fname" class="form-control" placeholder="First Name" required="required">
                                        </div>
                                    </div>
                                    <div class="no-padding-left col-lg-4">
                                        <div class="form-group">
                                            <label for="middle-name">Middle Name:</label>
                                            <input type="text" name="user-mname" class="form-control" placeholder="Middle Name" required="required">
                                        </div>
                                    </div>
                                    <div class="no-padding col-lg-4">
                                        <div class="form-group">
                                            <label for="last-name">Last Name:</label>
                                            <input type="text" name="user-lname" class="form-control" placeholder="Last Name" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="no-padding-left col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Contact Number:</label>
                                            <input type="number" name="status-contact" class="form-control" placeholder="Contact Number" required="required">
                                        </div>
                                    </div>
                                    <div class="no-padding col-lg-6">
                                        <div class="form-group">
                                            <label for="type-id">Account Type:</label>
                                            <select class="form-control" name="type-id">
                                                <option value="2">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="user-address" class="form-control" placeholder="Address (Current)" required="required">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="user-username" class="form-control" placeholder="It will be the credential for username" required="required">
                        </div>
                        <div class="mb10">
                            <div class="clearfix">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="password">Password:</label>
                                        <input type="password" name="user-password" class="form-control" placeholder="It will be the credential for password" required="required">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="password">Confirm Password:</label>
                                        <input type="password" class="form-control confirm-password-add" placeholder="Confirm password is to verify your password" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb10">
                            <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                                <strong>Well done!</strong> You have successfully added the user.
                            </div>
                            <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                                <strong>Oooops!</strong> Change a few things up and try submitting again.
                            </div>
                            <div class="alert alert-warning process-alert-exist hidden mb0" role="alert">
                                <strong>Attention!</strong> This user is already exist.
                            </div>
                        </div>
                        <div class="mb10">
                            <div class="alert alert-danger password-alert-error hidden mb0" role="alert">
                                <strong>Oooops!</strong> <span class="password-error-text"></span>
                            </div>
                        </div>
                        <div class="clearfix">
                            <p class="pull-right mb0">
                                <button type="submit" class="btn btn-primary user-button-add">Submit</button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="supplier hidden">
                    <form class="col-lg-12 form-add form-add-suppliers" autocomplete="off">
                        <div class="mb10">
                            <label for="company-name">Company Name:</label>
                            <input type="text" name="supplier-name" class="form-control" placeholder="Company Name of the supplier" required="required">
                        </div>
                        <div class="mb10">
                            <label for="contact">Contact Email:</label>
                            <input type="email" name="supplier-contact" class="form-control" placeholder="Contact Number" required="required">
                        </div>
                        <div class="mb10">
                            <label for="company-address">Company Address:</label>
                            <input type="text" name="supplier-address" class="form-control" placeholder="Company address of the supplier" required="required">
                        </div>
                        <div class="mb10">
                            <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                                <strong>Well done!</strong> You have successfully added the supplier.
                            </div>
                            <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                                <strong>Oooops!</strong> Change a few things up and try submitting again.
                            </div>
                        </div>
                        <div class="clearfix">
                            <p class="pull-right mb0">
                                <button type="submit" class="btn btn-primary supplier-button-add">Submit</button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="cms hidden">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <form class="cms-form-add-cms" data-code="generic" autocomplete="off">
                                            <div class="form-group">
                                                <label for="generic-name">Generic Name:</label>
                                                <input type="text" name="generic-name-opt" placeholder="Generic Name" class="form-control" required="required">
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="glyphicon glyphicon-plus"></i> &nbsp;Add
                                                </button>
                                            </div>
                                        </form>
                                        <div class="clearfix">
                                            <ul class="list-item-display generic">
                                                <?php require_once('../controls/generic-cms.php'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <form class="cms-form-add-cms" data-code="dosage" autocomplete="off">
                                            <div class="form-group">
                                                <label for="dosage">Dosage:</label>
                                                <input type="text" name="dosage-opt" placeholder="Dosage" class="form-control" required="required">
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="glyphicon glyphicon-plus"></i> &nbsp;Add
                                                </button>
                                            </div>
                                        </form>
                                        <div class="clearfix">
                                            <ul class="list-item-display dosage">
                                                <?php require_once('../controls/dosage-cms.php'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <form class="cms-form-add-cms" data-code="category" autocomplete="off">
                                            <div class="form-group">
                                                <label for="generic-name">Category Name:</label>
                                                <input type="text" name="category-name-opt" placeholder="Category Name" class="form-control" required="required">
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="glyphicon glyphicon-plus"></i> &nbsp;Add
                                                </button>
                                            </div>
                                        </form>
                                        <div class="clearfix">
                                            <ul class="list-item-display category">
                                                <?php require_once('../controls/category-cms.php'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <form class="cms-form-add-cms" data-code="variant" autocomplete="off">
                                            <div class="form-group">
                                                <label for="generic-name">Variant Name:</label>
                                                <input type="text" name="variant-name-opt" placeholder="Variant Name" class="form-control" required="required">
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="glyphicon glyphicon-plus"></i> &nbsp;Add
                                                </button>
                                            </div>
                                        </form>
                                        <div class="clearfix">
                                            <ul class="list-item-display variant">
                                                <?php require_once('../controls/variant-cms.php'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manage-user hidden">
                <p class="filter-accounts clearfix mb10">
                    <a href="#inactive" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span> &nbsp;Inactive accounts</a>
                </p>
                <table class="table mb0">
                    <thead class="tbl-heading">
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Username</th>
                            <th class="text-center">Status</th>
                            <th class="cmd-action text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbl-body">
                        <?php require_once('../controls/accounts.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="inventory hidden" data-code="product">
                <p class="filter-inventory clearfix mb10">
                    <a href="#generic" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-barcode"></span> &nbsp;Generic Inventory</a>
                </p>
                <table class="table table-responsive table-hovered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Generic Name</th>
                            <th>Category</th>
                            <th class="text-center">Dosage</th>
                            <th class="text-center">Expiration Date</th>
                            <th class="text-center">Quantity (Box)</th>
                            <th class="text-center">Quantity (Piece)</th>
                            <th class="text-center">Price (Box)</th>
                            <th class="text-center">Price (Piece)</th>
                            <th class="text-center">Maintenance</th>
                        </tr>
                    </thead>
                    <tbody class="inventory-table">
                        <?php require_once('../controls/products.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="suppliers hidden">
                <p class="filter-suppliers clearfix mb10">
                    <a href="#inactive" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span> &nbsp;Inactive suppliers</a>
                </p>
                <table class="table mb0">
                    <thead class="tbl-heading">
                        <tr>
                            <th>No.</th>
                            <th>Company Name</th>
                            <th>Company Contact</th>
                            <th>Company Address</th>
                            <th>Date Approved</th>
                            <th class="text-center">Supplier Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbl-suppliers">
                        <?php require_once('../controls/suppliers.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="generate-report hidden">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-primary pull-left btn-report-summary" data-code="all">
                                Summary Details &nbsp;<i class="glyphicon glyphicon-list-alt"></i>
                            </button>
                        </div>
                        <form class="search-generate-report col-lg-4">
                            <div class="input-group">
                                <input type="text" name="generate-report-index" placeholder="Choose date here" class="form-control date-range-picker">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-search"></span> &nbsp; Search
                                    </button>
                                </span>
                            </div>
                        </form>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-primary btn-report pull-right">
                                Generate Report &nbsp;( <span class="glyphicon glyphicon-print"></span> Print )
                            </button>
                        </div>
                    </div>
                </div>
                <span class="help-block"></span>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Transaction Number</th>
                            <th>Transaction Price</th>
                            <th>Transaction Discount</th>
                            <th>Transaction Date</th>
                            <th>Transaction Responsible</th>
                        </tr>
                    </thead>
                    <tbody class="table-report generate-report-ajax">
                        <?php require_once('../controls/generate-report.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="notify-supplier hidden">
                <form class="form-notify-supplier">
                    <div class="form-group mb10">
                        <label for="email-supplier">Supplier Contact:</label>
                        <select class="form-control" name="supplier-email" required="required">
                            <?php require('../controls/suppliers-contact.php'); ?>
                        </select>
                    </div>
                    <div class="form-group mb10">
                        <label for="supplier-message">Message:</label>
                        <textarea name="supplier-message" class="form-control supplier-message" placeholder="Your message to the selected supplier" required="required"></textarea>
                    </div>
                    <div class="clearfix">
                        <label for="supplier-message">Stock check: Name - Variant (Piece / Box)</label>
                        <div class="well well-sm mb10 critical-supplier-content">
                            <?php require_once('../controls/notify-supplier-item.php'); ?>
                        </div>
                    </div>
                    <div class="mb10">
                        <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                            <strong>Well done!</strong> Your message was sent successfully to your supplier..
                        </div>
                        <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                            <strong>Oooops!</strong> You cant send a message via local server, it must be on a live hosting.
                        </div>
                    </div>
                    <div class="clearfix">
                        <p class="pull-right mb0">
                            <button type="submit" class="btn btn-primary supplier-button-email">Send</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<div class="manage-user-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="manage-user-process" autocomplete="off">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Account</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="user-lname" class="form-control user-lname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="no-padding-left col-lg-3">
                            <input type="text" name="user-mname" class="form-control user-mname" placeholder="Middle Name">
                        </div>
                        <div class="no-padding-left col-lg-4">
                            <input type="text" name="user-fname" class="form-control user-fname" placeholder="First Name">
                        </div>
                    </div>
                    <span class="help-block"></span>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-home"></span>
                                </span>
                                <input type="text" name="user-address" placeholder="Address (Current)" class="form-control input-group user-address">
                            </div>
                        </div>
                        <div class="no-padding-left col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-earphone"></span>
                                </span>
                                <input type="number" name="status-contact" placeholder="Contact number" class="form-control input-group user-phone">
                            </div>
                        </div>
                    </div>
                    <span class="help-block process-block hidden"></span>
                    <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                        <strong>Well done!</strong> You successfully update the information.
                    </div>
                    <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                        <strong>Oooops!</strong> Change a few things up and try submitting again.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary accounts-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="delete-confirm-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="delete-process-confirm" autocomplete="off">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Confirmation!</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h4 class="text-center mt0">Are you sure to removed or deactivate this user ?</h4>
                    </div>
                    <div class="alert alert-danger mb0" role="alert">
                        <strong>NOTE:</strong> This account will not be totally deleted it will only deactivate for future reference.
                    </div>
                    <span class="help-block process-block hidden"></span>
                    <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                        <strong>Well done!</strong> You have successfully deactivate the account.
                    </div>
                    <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                        <strong>Oooops!</strong> Change a few things up and try submitting again.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger delete-proceed">Proceed</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="suppliers-update-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="suppliers-update-form" autocomplete="off">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Supplier</h4>
                </div>
                <div class="modal-body clearfix">
                    <p class="col-lg-1"></p>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="input-group-addon">Company Name &nbsp;&nbsp;&nbsp;</span>
                            <input type="text" name="supplier-name" placeholder="Company Name" class="supplier-name form-control">
                        </div>
                        <span class="help-block"></span>
                        <div class="input-group">
                            <span class="input-group-addon">Company Contact</span>
                            <input type="number" name="supplier-contact" placeholder="Company Contact" class="supplier-contact form-control">
                        </div>
                        <span class="help-block"></span>
                        <div class="input-group">
                            <span class="input-group-addon">Company Address</span>
                            <input type="text" name="supplier-address" placeholder="Company Address" class="supplier-address form-control">
                        </div>
                        <span class="help-block process-block hidden"></span>
                        <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                            <strong>Well done!</strong> You successfully update the information.
                        </div>
                        <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                            <strong>Oooops!</strong> Change a few things up and try submitting again.
                        </div>
                    </div>
                    <p class="col-lg-1"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary suppliers-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="supplier-delete-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="delete-supplier-form" autocomplete="off">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Confirmation!</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h4 class="text-center mt0">Are you sure to removed or deactivate this supplier ?</h4>
                    </div>
                    <div class="alert alert-danger mb0" role="alert">
                        <strong>NOTE:</strong> This account will not be totally deleted it will only deactivate for future reference.
                    </div>
                    <span class="help-block process-block hidden"></span>
                    <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                        <strong>Well done!</strong> You have successfully deactivate the account.
                    </div>
                    <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                        <strong>Oooops!</strong> Change a few things up and try submitting again.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger supplier-delete-proceed">Proceed</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="id-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-white">Ooooops!</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>No Match Found!</strong>
                    <span class="help-block"></span>
                    <p>
                        You have declared an invalid key. Please check the key that you declared, maybe it's replaced.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">I understand</button>
            </div>
        </div>
    </div>
</div>
<div class="inventory-delete-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-white">Confirmation!</h4>
            </div>
            <div class="modal-body">
                <h4 class="mt0 text-center">Are you sure you want to delete this product ?</h4>
                <div class="alert alert-danger alert-dismissible mb0" role="alert">
                    <p><strong>NOTE:</strong> It will deleted permanently. </p>
                </div>
                <span class="help-block process-block hidden"></span>
                <div class="alert alert-success process-alert-success hidden mb0" role="alert">
                    <strong>Well done!</strong> You have successfully delete this product.
                </div>
                <div class="alert alert-danger process-alert-error hidden mb0" role="alert">
                    <strong>Oooops!</strong> Change a few things up and try submitting again.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger inventory-delete">Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="inventory-update-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-update-inventory">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Product</h4>
                </div>
                <div class="modal-body inventory-update-content"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary inventory-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="summary-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-update-inventory">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Summary</h4>
                </div>
                <div class="modal-body summary-content"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="expiration-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-update-inventory">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-white">Expiration Validation</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center alert alert-danger mb0">
                        You cannot enter an expiration date within this day or atleast 4 months of expiration date starting from date today.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php else: ?>
    <?php header("Location: ../login"); ?>
<?php endif; ?>
