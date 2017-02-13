<?php if(isset($_SESSION['type_id']) && (int) $_SESSION['status_remarks'] === 1): ?>
<main class="site-content container">
    <span class="help-block"></span>
    <p class="text-right time"></p>
    <span class="help-block"></span>
    <ul class="nav nav-tabs nav-justified user-tabs mb10">
        <li class="active"><a href="#"><i class="glyphicon glyphicon-barcode"></i> &nbsp;Branded</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-barcode"></i> &nbsp;Generic</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list"></i> &nbsp;Checkout</a></li>
    </ul>
    <span class="help-block"></span>
    <div class="panel panel-default mb10">
        <div class="panel-heading">
            <h3 class="panel-title admin-title user-title">Dashboard</h3>
        </div>
        <div class="panel-body">
            <div class="branded table-responsive">
                <form class="search-form clearfix" data-code="product">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control focus" placeholder="Search for Products">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </form>
                <table class="table mb0">
                    <thead>
                        <tr>
                            <th>Branded Name</th>
                            <th>Category Name</th>
                            <th>Generic Name</th>
                            <th class="text-center">Dosage</th>
                            <th class="text-center">Expiration Date</th>
                            <th class="text-center">Price (Piece)</th>
                            <th class="text-center">Quantity (Piece)</th>
                            <th class="text-center">Price (Box)</th>
                            <th class="text-center">Quantity (Box)</th>
                            <th class="text-center">Process</th>
                        </tr>
                    </thead>
                    <tbody class="products-content">
                        <?php require_once('../controls/pos-products.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="generic table-responsives hidden">
                <form class="search-form clearfix" data-code="brand">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control focus" placeholder="Search for Brands">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </form>
                <table class="table mb0">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Generic Name</th>
                            <th class="text-center">Dosage</th>
                            <th class="text-center">Expiration Date</th>
                            <th class="text-center">Price (Piece)</th>
                            <th class="text-center">Quantity (Piece)</th>
                            <th class="text-center">Price (Box)</th>
                            <th class="text-center">Quantity (Box)</th>
                            <th class="text-center">Process</th>
                        </tr>
                    </thead>
                    <tbody class="brands-content">
                        <?php require_once('../controls/pos-brands.php'); ?>
                    </tbody>
                </table>
            </div>
            <div class="checkout hidden table-responsive">
                <div class="clearfix">
                    <div class="pull-left citizen no-padding-left col-lg-4">
                        <form class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></span>
                            <input type="text" name="discount" placeholder="Citizen ID" class="form-control citizen-id">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-citizen-id" type="button">Accept no ID</button>
                            </span>
                        </form>
                    </div>
                    <p class="pull-right">
                        <button type="button" class="btn btn-danger cancel-trans"><span class="glyphicon glyphicon-remove"></span> &nbsp; Cancel Transaction</button>
                        <button type="button" class="btn btn-primary finish-trans"><span class="glyphicon glyphicon-print"></span> &nbsp; Finish Transaction</button>
                    </p>
                    <p class="citizen-discount print-css"></p>
                </div>
                <table class="table mb0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Item Name</th>
                            <th class="text-center">Quantity (Piece)</th>
                            <th class="text-center">Item Price (Piece)</th>
                            <th class="text-center">Quantity (Box)</th>
                            <th class="text-center">Item Price (Box)</th>
                            <th>Total Price</th>
                            <th>Date Purchased</th>
                            <th>Cashier</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="checkout-content">
                        <?php require_once('../controls/pos-checkout-details.php'); ?>
                    </tbody>
                </table>
                <span class="help-block delete-block hidden"></span>
                <div class="alert alert-success user-alert-delete-success mb0 hidden" role="alert">
                    <strong>Well done!</strong> The item that you have selected is now deleted. If you want that item again, just purchase it.
                </div>
                <div class="alert alert-danger user-alert-finish-trans mb0 hidden" role="alert">
                    <strong>Oooops!</strong> You don't have any transaction yet.
                </div>
                <span class="help-block print-css"></span>
                <div class="well well-sm mb0 print-css">
                    <strong>NOTE: </strong> Please keep this transaction so that if you have complain,
                    please give this sales invoice of what you have purchased. Thank you and come again.
                </div>
            </div>
        </div>
    </div>
</main>
<div class="purchase-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-pos-purchase">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title title-user text-white"></h4>
                </div>
                <div class="modal-body purchase-content">
                    <div class="row">
                        <div class="col-lg-12 cart-selection">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary btn-block btn-cart" data-code="piece">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> &nbsp; Pieces
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary btn-block btn-cart" data-code="box">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> &nbsp; Boxes
                                </button>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="col-lg-12 cart-piece hidden">
                            <label for="qtyperpiece">Quantity (Piece):</label>
                            <input type="number" class="form-control qtyperpiece" min="1" max="100">
                        </div>
                        <div class="col-lg-12 cart-box hidden">
                            <label for="qtyperbox">Quantity (Box):</label>
                            <input type="number" class="form-control qtyperbox" min="1" max="100">
                        </div>
                        <div class="col-lg-12">
                            <span class="help-block user-block hidden"></span>
                            <div class="alert alert-success user-alert-success hidden mb0" role="alert">
                                <strong>Well done!</strong> The item has been purchased.
                            </div>
                            <div class="alert alert-danger user-alert-invalid hidden mb0" role="alert">
                                <strong>Note!</strong> The system will not allow to submit without the number of piece or box.
                            </div>
                            <div class="alert alert-danger user-alert-error hidden mb0" role="alert">
                                <strong>Oooops!</strong> Change a few things up and try submitting again.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer cart-footer hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-purchase-proceed">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="payment-modal modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="payment-cash">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title title-user text-white">Payment</h4>
                </div>
                <div class="modal-body purchase-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="payment-to-check">Total:</label>
                                        <input type="text" readonly="readonly" class="form-control payment-check">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="payment-all-cash">Cash:</label>
                                        <input type="number" name="payment-cash-all" placeholder="Enter cash here" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning mb0 payment-message hiddent">
                        <strong>NOTE: </strong> You cannot proceed if the cash is less than in your total payment.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-payment">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php else: ?>
    <?php header("Location: ../login"); ?>
<?php endif; ?>
