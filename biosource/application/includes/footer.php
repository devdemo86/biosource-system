        <?php if(isset($_SESSION['type_id'])): ?>
        <footer class="site-footer">
            <div class="container">
                <p class="text-center">
                    <span>Copyright &copy; BIOSOURCE Drug Store - 2016. All rights reserved.</span>
                </p>
            </div>
        </footer>
        <div class="sign-out-modal modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-white">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure you want to signing out and leave all what you do ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger sign-out">Sign out</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="changepass-modal modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-changepass form-group">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title text-white">Change Password</h4>
                        </div>
                        <div class="modal-body clearfix">
                            <p class="col-lg-1"></p>
                            <div class="col-lg-10">
                                <div class="form-input input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> &nbsp;Old&nbsp;&nbsp;&nbsp;</span>
                                    <input type="password" placeholder="Old Password" name="form-old-pass" class="form-control input-group" required="required">
                                </div>
                                <div class="form-input input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> &nbsp;New&nbsp;</span>
                                    <input type="password" placeholder="New Password" name="form-new-pass" class="form-control input-group" required="required">
                                </div>
                                <div class="form-input input-group">
                                    <span class="input-group-addon">Confirm</span>
                                    <input type="password" placeholder="Confirm Password" name="form-confirm-pass" class="form-control input-group" required="required">
                                </div>
                                <div class="alert alert-danger alert-dismissible form-alert" role="alert">
                                    <strong>Password Mismatch!</strong>
                                    <span class="help-block"></span>
                                    <p>
                                        Your new password and confirm password should be match. Please check it again.
                                    </p>
                                </div>
                                <div class="alert alert-danger alert-dismissible noexist-alert" role="alert">
                                    <strong>No Match Found!</strong>
                                    <span class="help-block"></span>
                                    <p>
                                        You have entered an invalid old password. Please check your old password.
                                    </p>
                                </div>
                                <div class="alert alert-success alert-dismissible success-alert" role="alert">
                                    <strong>Successful!</strong>
                                    <span class="help-block"></span>
                                    <p>
                                        To secure the data, you should enter again your credentials,
                                        after 5 seconds it will logout automatically to enter your new credentials.
                                    </p>
                                </div>
                            </div>
                            <p class="col-lg-1"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-changepass">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="barcode-modal modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form class="modal-content barcode-form" autocomplete="off">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-white">Barcode Generator</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Branded / Generic Item:</label>
                                        <select class="form-control">
                                            <option value="">Select Item</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Barcode Generated:</label>
                                        <input type="text" name="barcode-generated" readonly="readonly" value="No item selected" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/jquery-3.1.0.min.js"></script>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo '/'.basename(dirname(dirname(__DIR__))); ?>/assets/js/app.js"></script>
    </body>
</html>
<?php else: ?>
    <?php header("Location: ../login"); ?>
<?php endif; ?>
