$(function() {

    var flag = true;

    $('.focus').focus();

    var getTimeDate = function() {
        var date = new Date(),
            sec = date.getSeconds().toString().length == 1 ? '0'+ date.getSeconds() : date.getSeconds(),
            min = date.getMinutes().toString().length == 1 ? '0'+ date.getMinutes() : date.getMinutes(),
            hour = date.getHours().toString().length == 1 ? '0'+ date.getHours() : date.getHours(),
            finalHour = hour == '00' ? '01' : hour,
            hourFormat = (finalHour + 11) % 12 + 1,
            miredian = finalHour >= 12 ? 'PM' : 'AM',
            month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            finalMonth = month[date.getMonth()],
            finalDay = date.getDate(),
            finalYear = date.getFullYear();
            finalTime = finalMonth +' '+ finalDay +', '+ finalYear +' at '+ hourFormat +':'+ min +':'+ sec +' '+ miredian;
        $('.time').text(finalTime);
        setTimeout(function() {
            getTimeDate();
        }, 1000);
    };
    getTimeDate();

    $('.form-login').submit(function(e) {
        e.preventDefault();
        var auth = $(this).serializeArray();
            $.ajax({
                url: '../application/controls/authentication.php',
                type: "POST",
                data: {userAuth: auth},
                success: function(result) {
                    if(result !== "zero") {
                        $(location).attr('href', '../application/'+ result);
                    } else {
                        $('.form-alert').css('margin-bottom', 0).toggle();
                    }
                },
                error: function() {
                    $(location).attr('href', 'errors/404');
                }
            });
    });

    $('.form-login input, .form-changepass input').keyup(function() {
        if($('.form-alert').is(':visible')) {
            $('.form-alert').toggle();
        } else if($('.noexist-alert').is(':visible')) {
            $('.noexist-alert').toggle();
        }
    });

    $('a[href^="#settings"]').click(function(e) {
        e.preventDefault();
        if($('.dropdown-option').is(':visible')) {
            $('.dropdown-option').fadeOut(250);
        } else {
            $('.dropdown-option').toggle();
        }
        $(this).parent().toggleClass('dropup');
    });

    $('a[href^="#logout"]').click(function(e) {
        e.preventDefault();
        $('.sign-out-modal').modal({
            keyboard: false,
            backdrop: 'static'
        });
    });

    $('.sign-out').click(function() {
        $(location).attr('href', '../controls/logout');
    });

    $('a[href^="#changepass"]').click(function(e) {
        e.preventDefault();
        $('.changepass-modal').modal({
            keyboard: false,
            backdrop: 'static'
        });
    });

    $('.form-changepass').submit(function(e) {
        e.preventDefault();
        var pass = $(this).serializeArray();
            npass = pass[1].value,
            cpass = pass[2].value;
        if(npass === cpass) {
            $('.btn-changepass').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
            $.ajax({
                url: '../controls/password.php',
                type: 'POST',
                data: {passwords: pass},
                success: function(result) {
                    $('.btn-changepass').text('Updated').css('opacity', 1).removeAttr('disabled');
                    if(result !== "zero") {
                        if(result === "success") {
                            $('.form-changepass input').val('');
                            $('.success-alert').css('margin-bottom', 0).toggle();
                            setTimeout(function() {
                                $(location).attr('href', '../controls/logout');
                            }, 5000);
                        } else {
                            $(location).attr('href', '../errors/dberror');
                        }
                    } else {
                        $('.noexist-alert').css('margin-bottom', 0).toggle();
                    }
                },
                error: function() {
                    $(location).attr('href', '../errors/404');
                }
            });
        } else {
            $('.form-alert').css('margin-bottom', 0).toggle();
        }
    });

    $('.admin-tabs li a, .user-tabs li a').click(function(e) {
        e.preventDefault();
        var getText = $(this).text().trim(),
            getLength = getText.split(' ').length,
            setSelector;
            if(getLength === 1) {
                if(!$(this).parent('li').hasClass('active')) {
                    setSelector = getText.toLowerCase();
                }
            } else {
                setSelector = getText.toLowerCase().replace(' ', '-');
            }
        $('.'+ setSelector).removeClass('hidden').siblings().addClass('hidden');
        $('.admin-title').text(getText);
        $(this).parent('li').addClass('active').siblings().removeClass('active');
    });

    $('.add-tabs li a').click(function(e) {
        e.preventDefault();
        $('.admin-title').text('Add - '+ $(this).text().trim());
        $('.'+ $(this).text().replace('Add - ', '').trim().toLowerCase()).removeClass('hidden').siblings('div').addClass('hidden');
        $(this).parent('li').addClass('active').siblings().removeClass('active');
    });

    $('.add-tabs').click(function(e) {
        e.preventDefault();
        $('.process-block, .process-alert-success, .process-alert-error, process-alert-exist').addClass('hidden');
    });

    $('.form-add-suppliers').submit(function(e) {
        e.preventDefault();
        var getSupplier = $(this).serializeArray();
        $('.supplier-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/suppliers-add.php',
            type: 'POST',
            data: {supplier: getSupplier},
            success: function(result) {
                $('.supplier-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.form-add-user').submit(function(e) {
        e.preventDefault();
        var getUser = $(this).serializeArray();
        $('.user-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/accounts-add.php',
            type: 'POST',
            data: {user: getUser},
            success: function(result) {
                $('.user-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error, .process-alert-exist').addClass('hidden');
                } else if(result == 'exist') {
                    $('.process-block, .process-alert-exist').removeClass('hidden');
                    $('.process-alert-error, .process-alert-success').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success, .process-alert-exist').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.form-add-brand').submit(function(e) {
        e.preventDefault();
        var getBrand = $(this).serializeArray();
        $('.brand-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/brands-add.php',
            type: 'POST',
            data: {brand: getBrand},
            success: function(result) {
                $('.brand-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.form-add-product').submit(function(e) {
        e.preventDefault();
        var getProduct = $(this).serializeArray();
        $('.product-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/products-add.php',
            type: 'POST',
            data: {product: getProduct},
            success: function(result) {
                $('.product-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.filter-accounts a, .filter-suppliers a').click(function(e) {
        e.preventDefault();
        var getHref = $(this).attr('href'),
            getClass = $(this).attr('class'),
            getFile = '../controls/accounts.php',
            replaceFrom = null,
            replaceTo = null;
            status = null,
            remarks = 0,
            icon = null,
            category = 'accounts';
            if(getHref.match('#inactive')) {
                $(this).attr('href', '#active');
                replaceFrom = 'danger';
                replaceTo = 'primary';
                status = 'Active';
                icon = 'user';
            } else {
                $(this).attr('href', '#inactive');
                replaceFrom = 'primary';
                replaceTo = 'danger';
                status = 'Inactive';
                remarks = 1;
                icon = 'trash';
            }
        $('.tbl-heading tr th:last-child').toggleClass('action-hide');
        if($(this).parent().hasClass('filter-suppliers')) {
            getFile = '../controls/suppliers.php';
            flag = false;
            category = 'suppliers';
        }
        $(this).attr('class', getClass.replace(replaceFrom, replaceTo)).html('<span class="glyphicon glyphicon-'+ icon +'"></span> &nbsp;'+ status +' '+ category);
        $.ajax({
            url: getFile,
            type: 'POST',
            data: {id: remarks},
            success: function(result) {
                var selector = flag ? 'body' : 'suppliers';
                $('.tbl-'+ selector).html(result);
            }
        });
        $(document).ajaxComplete(function() {
            flag = true;
        });
    });

    $('body').delegate('a[href^="#update"], a[href^="#delete"]', 'click', function(e) {
        e.preventDefault();
        var getId = $(this).attr('id'),
            getCode = $(this).attr('data-code'),
            getOption = $(this).attr('href').split('#'),
            getClassmodal = $('.admin-title').text().toLowerCase().replace(' ', '-'),
            modalSelect = $('.'+ getClassmodal +'-modal'),
            modalContent = $('.'+ getClassmodal +'-process'),
            repHeader = modalSelect.find('.modal-header').attr('class'),
            repFrom = null,
            repTo = null;
        $('.process-block, .process-alert-success, .process-alert-error').addClass('hidden');
            $.ajax({
                url: '../controls/'+ getCode +'-'+ getOption[1] +'.php',
                type: 'POST',
                data: {user: getId},
                success: function(result) {
                    if(result !== 'invalid') {
                        if(result !== 'id-error') {
                            if(getCode === 'accounts') {
                                if(getOption[1] === 'delete') {
                                    $('.delete-process-confirm').attr('id', getId);
                                    $('.delete-confirm-modal').modal();
                                } else {
                                    var getAccount = $.parseJSON(result);
                                    modalContent.attr('id', getAccount.user_id);
                                    $('.user-lname').val(getAccount.user_lname);
                                    $('.user-mname').val(getAccount.user_mname);
                                    $('.user-fname').val(getAccount.user_fname);
                                    $('.user-address').val(getAccount.user_address);
                                    $('.user-phone').val(getAccount.status_contact);
                                    modalSelect.modal();
                                }
                            } else {
                                if(getOption[1] === 'delete') {
                                    $('.delete-supplier-form').attr('id', getId);
                                    $('.supplier-delete-modal').modal();
                                } else {
                                    var getInfo = $.parseJSON(result);
                                    $('.suppliers-update-form').attr('id', getInfo.supplier_id);
                                    $('.supplier-name').val(getInfo.supplier_name);
                                    $('.supplier-contact').val(getInfo.supplier_contact);
                                    $('.supplier-address').val(getInfo.supplier_address);
                                    $('.suppliers-update-modal').modal();
                                }
                            }
                        } else {
                            $('.id-modal').modal();
                        }
                    } else {
                        $(location).attr('href', '../errors/404');
                    }
                },
                error: function() {
                    $(location).attr('href', '../errors/404');
                }
            });
    });

    $('.manage-user-process').submit(function(e) {
        e.preventDefault();
        $('.accounts-update').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
        var getData = $(this).serializeArray(),
            getId = $(this).attr('id');
        $.ajax({
            url: '../controls/accounts-update.php',
            type: 'POST',
            data: {userupdate: getData, userid: getId},
            success: function(result) {
                $('.accounts-update').text('Save changes').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        });
    });

    $('.delete-process-confirm').submit(function(e) {
        e.preventDefault();
        var getId = $(this).attr('id');
        $('.delete-proceed').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/accounts-delete.php',
            type: 'POST',
            data: {userid: getId},
            success: function(result) {
                $('.delete-proceed').text('Proceed').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        })
    });

    $('.suppliers-update-form').submit(function(e) {
        e.preventDefault();
        $('.suppliers-update').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
        var getId = $(this).attr('id'),
            getData = $(this).serializeArray();
        $.ajax({
            url: '../controls/suppliers-update.php',
            type: 'POST',
            data: {userid: getId, userdata: getData},
            success: function(result) {
                $('.suppliers-update').text('Save changes').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        });
    });

    $('.delete-supplier-form').submit(function(e) {
        e.preventDefault();
        var getId = $(this).attr('id');
        $('.supplier-delete-proceed').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/suppliers-delete.php',
            type: 'POST',
            data: {userid: getId},
            success: function(result) {
                $('.supplier-delete-proceed').text('Save changes').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        });
    });

    $('.form-notify-supplier').submit(function(e) {
        e.preventDefault();
        var getInfo = $(this).serializeArray();
        $('.supplier-button-email').text('Sending...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/suppliers-notify.php',
            type: 'POST',
            data: {send: getInfo},
            success: function(result) {
                $('.supplier-button-email').text('Send').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        });
    });

    $('a[href^="#prod-update"]').click(function(e) {
        e.preventDefault();
        var product = $(this).attr('data-id');
        $('.form-update-inventory').attr('data-id', product);
        $.ajax({
            url: '../controls/products-update.php',
            type: 'POST',
            data: {prodid: product},
            success: function(result) {
                $('.inventory-update-content').html(result);
                $('.inventory-update-modal').modal();
            },
            error: function() {
                $(location).attr('href', '../errors/404');
            }
        });
    });

    $('.form-update-inventory').submit(function(e) {
        e.preventDefault();
        $('.inventory-update').text('Updating...').css('opacity', '.8').attr('disabled', 'disabled');
        var getId = $(this).attr('data-id'),
            getProd = $(this).serializeArray();
            $.ajax({
                url: '../controls/products-update.php',
                type: 'POST',
                data: {updateid: getId, product: getProd},
                success: function(result) {
                    $('.inventory-update').text('Save changes').css('opacity', 1).removeAttr('disabled');
                    if(result === 'success') {
                        $('.process-block, .process-alert-success').removeClass('hidden');
                        $('.process-alert-error').addClass('hidden');
                    } else {
                        $('.process-block, .process-alert-error').removeClass('hidden');
                        $('.process-alert-success').addClass('hidden');
                    }
                },
                error: function() {
                    $(location).attr('href', '../errors/404');
                }
            });
    });

    var inventory = null;
    $('a[href^="#prod-delete"]').click(function(e) {
        e.preventDefault();
        inventory = $(this).attr('data-id');
        $('.inventory-delete-modal').modal();
    });

    $('.inventory-delete').click(function() {
        $(this).text('Deleting...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/products-delete.php',
            type: 'POST',
            data: {prodid: inventory},
            success: function(result) {
                $('.inventory-delete').text('Proceed').css('opacity', 1).removeAttr('disabled');
                if(result === 'success') {
                    $('.process-block, .process-alert-success').removeClass('hidden');
                    $('.process-alert-error').addClass('hidden');
                } else {
                    $('.process-block, .process-alert-error').removeClass('hidden');
                    $('.process-alert-success').addClass('hidden');
                }
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('body').delegate('a[href^="#brands"], a[href^="#products"]', 'click', function(e) {
        e.preventDefault();
        var getHref = $(this).attr('href').replace('#', ''),
            newHref = getHref === 'brands' ? 'products' : 'brands',
            newUrl = getHref === 'brands' ? '../controls/brands.php' : '../controls/products.php',
            title = newHref.replace(newHref[0], newHref[0].toUpperCase());
        $(this).html('<span class="glyphicon glyphicon-barcode"></span> &nbsp;'+ title +' Inventory');
        $(this).attr('href', '#'+ newHref);
        $.ajax({
            url: newUrl,
            type: 'POST',
            data: {ajax: 1},
            success: function(result) {
                $('.inventory-table').html('').html(result);
            }
        });
    });

    if(document.URL == 'http://system.dev/biosource/application/admin/admin-home') {
        $.ajax({
            url: '../controls/generate-report.php',
            type: 'GET',
            data: {},
            success: function(result) {
                $('.table-report').html(result);
            }
        });
    }

    $('.btn-report').click(function() {
        window.print();
    });

    $('.qtyperpiece, .qtyperbox').keyup(function() {
        $('.user-block, .user-alert-success, .user-alert-invalid, .user-alert-error').addClass('hidden');
    });

    var counter = 0;
    $('.search-form').keyup(function(e) {
        e.preventDefault();
        var getSearch = $(this).serializeArray(),
            search = $(this).attr('data-code');
        if($.trim($(this).find('input').val()) != "") {
            counter++;
            $.ajax({
                url: '../controls/search.php',
                type: 'POST',
                data: {searchId: getSearch, searchType: search},
                success: function(result) {
                    if(result !== 'zero') {
                        $('.'+ search +'s-content').html(result);
                    } else {
                        $('.'+ search +'s-content').html('<tr class="zero"><td colspan="10"><h3 class="mt0"><span class="label label-default">'+ result.replace(result[0], result[0].toUpperCase()) +' Result.</span></h3></td></tr>');
                    }
                }
            });
        } else {
            if(counter != 0) {
                $('.'+ search +'s-content').html('<tr class="zero"><td colspan="10"><h3 class="mt0"><span class="label label-default">Please refresh the page.</span></h3></td></tr>');
            }
        }
    });

    var getType = null;
    $('body').delegate('.btn-purchase', 'click', function() {
        var getData = $(this).attr('data-id');
            getType = $(this).parents('tr').attr('data-id');
        $('.form-pos-purchase').attr('data-id', getData);
        $('.title-user').text($(this).parents('tr').find('.purchase-name').text());
        $('.user-block, .user-alert-success, .user-alert-invalid, .user-alert-error').addClass('hidden');
        $.ajax({
            url: '../controls/pos-check.php',
            type: 'POST',
            data: {dataid: getData, datatype: getType},
            success: function(result) {
                var getPlaceholder = result.split('#');
                $('.qtyperpiece').attr('name', getType +'_qtyperpiece').attr('placeholder', 'Available for piece is '+ getPlaceholder[0]);
                $('.qtyperbox').attr('name', getType +'_qtyperbox').attr('placeholder', 'Available for box is '+ getPlaceholder[1]);
                $('.purchase-modal').modal();
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.form-pos-purchase').submit(function(e) {
        e.preventDefault();
        $('.btn-purchase-proceed').text('Processing...').css('opacity', '.8').attr('disabled', 'disabled');
        var piece = $('.qtyperpiece').val(),
            box = $('.qtyperbox').val(),
            getId = $(this).attr('data-id'),
            quantity = false,
            getData = $(this).serializeArray();
        if(piece.trim() == "" || piece == null) {
            if(box.trim() == "" || box == null) {
                $('.user-block, .user-alert-invalid').removeClass('hidden');
                $('.btn-purchase-proceed').text('Submit').css('opacity', 1).removeAttr('disabled');
            } else {
                quantity = true;
            }
        } else if(box.trim() == "" || box == null) {
            if(piece.trim() == "" || piece == null) {
                $('.user-block, .user-alert-invalid').removeClass('hidden');
                $('.btn-purchase-proceed').text('Submit').css('opacity', 1).removeAttr('disabled');
            } else {
                quantity = true;
            }
        } else {
            quantity = true;
        }
        if(quantity) {
            $.ajax({
                url: '../controls/pos-checkout.php',
                type: 'POST',
                data: {dataid: getId, info: getData, datatype: getType},
                success: function(result) {
                    $('.user-block, .user-alert-success').removeClass('hidden');
                    $('.btn-purchase-proceed').text('Submit').css('opacity', 1).removeAttr('disabled');
                },
                error: function() {
                    $(location).attr('href', '../errors/dberror');
                }
            });
        }
    });

    $('.user-alert-delete-success, .delete-block, .user-alert-finish-trans').addClass('hidden');
    $('body').delegate('.checkout-delete', 'click', function() {
        var getId = $(this).attr('data-id');
        $.ajax({
            url: '../controls/pos-checkout-delete.php',
            type: 'POST',
            data: {delid: getId},
            success: function() {
                $('.user-alert-delete-success, .delete-block').removeClass('hidden');
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    $('.cancel-trans').click(function() {
        $.ajax({
            url: '../controls/pos-checkout-cancel.php',
            type: 'POST',
            data: {trunc: true},
            success: function(result) {
                location.reload();
            },
            error: function() {
                $(location).attr('href', '../errors/dberror');
            }
        });
    });

    var citizen = false,
        getTotalTemp = 0,
        getTotalTempBool = true;
    $('.finish-trans').click(function() {
        console.log()
        if($('.checkout-content').find('tr.zero')[0]) {
            $('.user-alert-finish-trans, .delete-block').removeClass('hidden');
        } else {
            if(citizen === false) {
                citizen = $('.citizen-id').val().trim() == "" ? false : true;
            }
            $('.citizen-id').val().trim() == "" ? false : $('.citizen-discount').html('<strong>Citizen ID: </strong>'+ $('.citizen-id').val());
            if(citizen) {
                if(getTotalTempBool) {
                    getTotalTemp = $('.total-price').text().split('.')[0] +'.00';
                    getTotalTempBool = false;
                }
                var getCitizenId = $('.citizen-id').val(),
                    getTotal = $('.total-price').text().split('.')[0],
                    getCashier = $('.cashier').text(),
                    getFinalPrice = getCitizenId.trim() == "" ? getTotalTemp : getTotalTemp - (getTotal * 0.20),
                    getTotalPrice = getFinalPrice % 1 === 0 ? getFinalPrice : getFinalPrice.toFixed(2);
                    $('.total-price').text(getTotalPrice);
                    $.ajax({
                        url: '../controls/pos-transaction.php',
                        type: 'POST',
                        data: {proceed: true, citizen: getCitizenId, total: getTotalPrice, cashier: getCashier},
                        success: function(result) {
                            window.print();
                        },
                        error: function() {
                            $(location).attr('href', '../errors/dberror');
                        }
                    });
            } else {
                $('.citizen-id').focus();
            }
        }
    });

    $('.btn-citizen-id').click(function() {
        citizen = true;
    });

    $('.dashboard .list-group-item').click(function(e) {
        e.preventDefault();
        var getHref = $(this).attr('href').replace('#', '');
        alert(getHref);
    });

    $('.btn-report-summary').click(function() {
        var getCode = $(this).attr('data-code');
            if(getCode === 'all') {
                $(this).attr('data-code', 'individual');
                getCode = 'individual';
            } else {
                $(this).attr('data-code', 'all');
                getCode = 'all';
            }
            $.ajax({
                url: '../controls/generate-report.php',
                type: 'POST',
                data: {datacode: getCode},
                success: function(result) {
                    $('.table-report').html(result);
                }
            });
    });

});
