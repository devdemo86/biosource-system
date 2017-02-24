$(function() {

    var flag = true;

    $('.focus').focus();

    if(document.URL.match('admin-home')) {
        $('.date-range-picker').daterangepicker();
    }

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
                    if(result !== "zero" && result != "username" && result != "password") {
                        $(location).attr('href', '../application/'+ result);
                    } else {
                        if(result == "username") {
                            $('.alert').find('strong').text('Username Error!');
                        } else if(result == "password") {
                            $('.alert').find('strong').text('Password Error!');
                        } else {
                            $('.alert').find('strong').text('No Match Found!');
                        }
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

    $('a[href^="#generate-barcode"]').click(function(e) {
        e.preventDefault();
        $('.barcode-modal').modal();
    });

    $('a[href^="#forgot-password"]').click(function(e) {
        e.preventDefault();
        $('.forgot-password-modal').modal();
    });

    $('.alert-login').css('margin-top', '0').hide();
    $('.error-message').text('');
    $('.forgot-password-form').submit(function(e) {
        e.preventDefault();
        var passwordData = $(this).serializeArray(),
            userName = passwordData[0].value,
            newPassword = passwordData[1].value,
            confirmPassword = passwordData[2].value,
            checkLength = newPassword.length;
        if($.trim(newPassword) != '' && $.trim(confirmPassword) != '' && $.trim(userName) != '') {
            if(checkLength >= 8) {
                if(newPassword == confirmPassword) {
                    $.ajax({
                        url: '../application/controls/forgot-password.php',
                        type: 'POST',
                        data: {
                            accountModify: [
                                userName,
                                newPassword
                            ]
                        },
                        success: function(response) {
                            if(response != 'zero') {
                                var getClass = $('.alert-login').attr('class');
                                $('.error-message').text('Your password update successful. It reload after 3 seconds to secure your account.');
                                $('.alert-login').attr('class', getClass.replace('danger', 'success')).css('margin-top', '15px').show();;
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            } else {
                                $('.error-message').text('Your username is not valid');
                                $('.alert-login').css('margin-top', '15px').show();
                            }
                        }
                    });
                } else {
                    $('.error-message').text('Password and Confirm Password mismatched!');
                    $('.alert-login').css('margin-top', '15px').show();
                }
            } else {
                $('.error-message').text('Password atleast 8 characters.');
                $('.alert-login').css('margin-top', '15px').show();
            }
        } else {
            var message ;
            if($.trim(userName) == '') {
                message = 'Username should not be empty!';
            } else {
                message = $.trim(newPassword) == '' ? 'Password should not be empty.' : 'Confirm Password should not be empty.';
            }
            $('.alert-login').css('margin-top', '15px').show();
            $('.error-message').text(message);
        }
    });

    $('.forgot-password-form input').keyup(function() {
        $('.alert-login').css('margin-top', '0').hide();
        $('.error-message').text('');
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
        if(getUser[getUser.length - 1].value.length >= 8) {
            if(getUser[getUser.length - 1].value == $('.confirm-password-add').val()) {
                $('.user-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
                $.ajax({
                    url: '../controls/accounts-add.php',
                    type: 'POST',
                    data: {user: getUser},
                    success: function(result) {
                        $('.user-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                        if(result === 'success') {
                            $('.process-block, .process-alert-success').removeClass('hidden');
                            $('.process-alert-error, .process-alert-exist, .password-alert-error').addClass('hidden');
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
            } else {
                $('.password-error-text').text('Confirm password and password should match!');
                $('.password-alert-error').removeClass('hidden');
            }
        } else {
            $('.password-error-text').text('Password should be atleast 8 characters.');
            $('.password-alert-error').removeClass('hidden');
        }
    });

    $('.form-add-brand').submit(function(e) { //
        e.preventDefault();
        var getBrand = $(this).serializeArray();
        $('.brand-button-add').text('Saving...').css('opacity', '.8').attr('disabled', 'disabled');
        $.ajax({
            url: '../controls/brands-add.php',
            type: 'POST',
            data: {brand: getBrand},
            success: function(result) {
                $('.brand-button-add').text('Submit').css('opacity', 1).removeAttr('disabled');
                if(result != 'invalid-date') {
                    if(result === 'success') {
                        $('.process-block, .process-alert-success').removeClass('hidden');
                        $('.process-alert-error').addClass('hidden');
                    } else {
                        $('.process-block, .process-alert-error').removeClass('hidden');
                        $('.process-alert-success').addClass('hidden');
                    }
                } else {
                    $('.expiration-modal').modal();
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
                if(result != 'invalid-date') {
                    if(result === 'success') {
                        $('.process-block, .process-alert-success').removeClass('hidden');
                        $('.process-alert-error').addClass('hidden');
                    } else {
                        $('.process-block, .process-alert-error').removeClass('hidden');
                        $('.process-alert-success').addClass('hidden');
                    }
                } else {
                    $('.expiration-modal').modal();
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

    $('.form-notify-supplier select').change(function() {
        var getValSelected = $(this).val();
        if($.trim(getValSelected) != "") {
            $.ajax({
                url: '../controls/notify-supplier-item.php',
                type: 'POST',
                data: {selected: getValSelected, type: true},
                success: function(result) {
                    $('.critical-supplier-content').html(result);
                }
            });
        } else {
            $('.critical-supplier-content').html('No critical item');
        }
    });

    $('body').delegate('a[href^="#prod-update"]', 'click', function(e) {
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
    $('body').delegate('a[href^="#prod-delete"]', 'click', function(e) {
        e.preventDefault();
        inventory = $(this).attr('data-id');
        $('.inventory-delete-modal').modal();
    });

    $('.inventory-delete').click(function() {
        $(this).text('Deleting...').css('opacity', '.8').attr('disabled', 'disabled');
        var data = {prodid: inventory},
            dataUrl = '../controls/products-delete.php',
            dataCode = $('.inventory').attr('data-code');
        if(dataCode != 'product') {
            data = {brandid: inventory};
            dataUrl = '../controls/brands-delete.php';
        }
        $.ajax({
            url: dataUrl,
            type: 'POST',
            data: data,
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

    $('body').delegate('a[href^="#generic"], a[href^="#branded"]', 'click', function(e) {
        e.preventDefault();
        var getHref = $(this).attr('href').replace('#', ''),
            newHref = getHref === 'generic' ? 'branded' : 'generic',
            newUrl = getHref === 'generic' ? '../controls/brands.php' : '../controls/products.php',
            title = newHref.replace(newHref[0], newHref[0].toUpperCase());
        $(this).html('<span class="glyphicon glyphicon-barcode"></span> &nbsp;'+ title +' Inventory');
        $(this).attr('href', '#'+ newHref);
        $('.inventory').attr('data-code', newHref);
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
        $('.cart-piece, .cart-box, .cart-footer').addClass('hidden');
        $('.cart-selection').removeClass('hidden');
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

    $('.btn-cart').click(function() {
        $('.cart-selection').addClass('hidden');
        var getCode = $(this).attr('data-code'),
            showHide = getCode == 'piece' ? 'box' : 'piece';
        $('.cart-'+ getCode).removeClass('hidden');
        $('.cart-'+ showHide).addClass('hidden');
        $('.cart-footer').removeClass('hidden');
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
                $('.qtyperbox').focus();
                $('.user-block, .user-alert-invalid').removeClass('hidden');
                $('.btn-purchase-proceed').text('Submit').css('opacity', 1).removeAttr('disabled');
            } else {
                quantity = true;
            }
        } else if(box.trim() == "" || box == null) {
            if(piece.trim() == "" || piece == null) {
                $('.qtyperpiece').focus();
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
        var getId = $(this).attr('data-id'),
            piece = $(this).parents('tr').attr('data-piece'),
            box = $(this).parents('tr').attr('data-box'),
            editHTML = '';
        $('.error-delete').remove();
        $('.delete-checkout-confirm-cash').attr('delete-data-id', getId);
        if(piece != 0) {
            var classAppend = box > 0 ? ' class="form-group"' : '';
            editHTML += '<div'+ classAppend +'>';
                editHTML += '<label for="delete-how-many-piece">For Piece:</label>';
                editHTML += '<input type="number" min="0" max="'+ piece +'" data-check="'+ piece +'" name="delete-how-many-piece" class="form-control" value="'+ piece +'" placeholder="How many pieces?">';
            editHTML += '</div>';
        }
        if(box != 0) {
            editHTML += '<div class="clearfix">';
                editHTML += '<label for="delete-how-many-box">For Box:</label>';
                editHTML += '<input type="number" min="0" max="'+ piece +'" data-check="'+ box +'" name="delete-how-many-box" class="form-control" value="'+ box +'" placeholder="How many boxes?">';
            editHTML += '</div>';
        }
        $('.edit-delete-body').html(editHTML);
        $('.editable-delete-modal').modal();
    });

    $('.delete-checkout-confirm-cash').submit(function(e) {
        var getId = $(this).attr('delete-data-id'),
            getHowMany = $(this).serializeArray(),
            checkPiece = $(this).find('input').eq(0).attr('data-check'),
            checkBox = $(this).find('input').eq(1).attr('data-check'),
            proceed = false;
        e.preventDefault();
        $('.error-delete').remove();
        if(getHowMany.length == 1 && 'delete-how-many-piece' == getHowMany[0].name) {
            console.log(getHowMany[0].value <= parseInt(checkPiece))
            proceed = getHowMany[0].value > 0 && getHowMany[0].value != 0 && getHowMany[0].value <= parseInt(checkPiece) ? true : false;
        } else {
            if(getHowMany.length == 1 && 'delete-how-many-box' == getHowMany[1].name) {
                proceed = getHowMany[1].value > 0 && getHowMany[1].value != 0 && getHowMany[1].value <= parseInt(checkBox) ? true : false;
            } else {
                if((getHowMany[1].value >= 0 && getHowMany[1].value <= parseInt(checkBox)) && (getHowMany[0].value >= 0 && getHowMany[0].value <= parseInt(checkPiece))) {
                    proceed = true;
                } else {
                    proceed = false;
                }
            }
        }
        if(proceed) {
            $.ajax({
                url: '../controls/pos-checkout-delete.php',
                type: 'POST',
                data: {delid: getId, howMany: getHowMany},
                success: function(result) {
                    $('.editable-delete-modal').modal('hide');
                    $('.user-alert-delete-success, .delete-block').removeClass('hidden');
                },
                error: function() {
                    $(location).attr('href', '../errors/dberror');
                }
            });
        } else {
            var getEq = getHowMany[0].value == 0 || getHowMany[0].value > checkPiece ? 'Piece' : 'Box',
                htmlErrorContent = '<span class="error-delete help-block"></span>';
                htmlErrorContent += '<div class="alert alert-danger error-delete text-center" style="margin-bottom:0;">';
                htmlErrorContent += getEq +' Should not exceed the limit or equivalent to zero.';
                htmlErrorContent += '</div>';
            $('.edit-delete-body').append(htmlErrorContent);
        }
    });

    $('.cancel-trans').click(function() {
        $(this).text('Processing...')
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
        getTotalTempBool = true,
        getCitizenId,
        getTotal,
        getCashier,
        getFinalPrice,
        getTotalPrice;
    $('.finish-trans').click(function() {
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
                getCitizenId = $('.citizen-id').val();
                getTotal = $('.total-price').text().replace(',', '').split('.')[0];
                getCashier = $('.cashier').text();
                if(getTotalTemp.toString().match(',')) {
                    getTotalTemp = parseInt(getTotalTemp.replace(',', '').split('.')[0]);
                }
                getFinalPrice = $.trim(getCitizenId) == "" ? getTotalTemp * 1.00 : getTotalTemp - (parseInt(getTotal) * 0.20);
                getTotalPrice = Number(getFinalPrice.toFixed(1)).toLocaleString() +'.00';
                $('.total-price').text(getTotalPrice);
                $('.payment-check').val(getTotalPrice);
                $('.payment-modal').modal();
            } else {
                $('.citizen-id').focus();
            }
        }
    });

    $('.payment-message').addClass('hidden');

    $('.payment-cash input').keyup(function() {
        $('.payment-message').addClass('hidden');
    });

    $('.payment-cash').submit(function(e) {
        e.preventDefault();
        $(this).find('.btn-payment').text('Processing...').attr('disabled', 'disabled');
        var getCashierInput = $(this).serializeArray()[0].value,
            fromCashier = getCashierInput.replace(',', '').split('.')[0],
            fromAmountDue = getTotalPrice.replace(',', '').split('.')[0];
        if(parseInt(fromCashier) >= parseInt(fromAmountDue)) {
            var getCheck = (parseInt(fromCashier) - parseInt(fromAmountDue)) * 1.00;
            $.ajax({
                url: '../controls/pos-transaction.php',
                type: 'POST',
                data: {proceed: true, citizen: getCitizenId, total: fromCashier, cashier: getCashier, amount: fromAmountDue},
                success: function(result) {
                    $('.payment-cash').find('.btn-payment').text('Submit').removeAttr('disabled');
                    $('.payment-modal').modal('hide');
                    $('.change-price').text(Number(getCheck.toFixed(1)).toLocaleString());
                    $('.change-currency-modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    setTimeout(function() {
                        $('.change-currency-modal').modal('hide');
                        $(location).attr('href', 'transaction-print?transid='+ result);
                    }, 2000);
                },
                error: function() {
                    $(location).attr('href', '../errors/dberror');
                }
            });
        } else {
            $('.payment-cash').find('.btn-payment').text('Submit').removeAttr('disabled');
            $('.payment-message').removeClass('hidden');
        }
    });

    $('.btn-print-receipt').click(function() {
        window.print();
    });

    $('.btn-citizen-id').click(function() {
        citizen = true;
    });

    $('.dashboard .list-group-item').click(function(e) {
        e.preventDefault();
        var getHref = $(this).attr('href').replace('#', '');
        $('.summary-content').html('');
        $.ajax({
            url: '../controls/summary.php',
            type: 'POST',
            data: {type: getHref},
            success: function(response) {
                $('.summary-content').html(response);
                $('.summary-modal').modal();
            }
        });
    });

    $('.btn-report-summary').click(function() {
        var getCode = $(this).attr('data-code');
            if(getCode === 'all') {
                $(this).attr('data-code', 'individual');
                getCode = 'individual';
                $(this).html('Specific Details &nbsp;<i class="glyphicon glyphicon-list-alt"></i>');
            } else {
                $(this).attr('data-code', 'all');
                getCode = 'all';
                $(this).html('Summary Details &nbsp;<i class="glyphicon glyphicon-list-alt"></i>');
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

    $('.cms-form-add-cms').submit(function(e) {
        e.preventDefault();
        var getVal = $(this).serializeArray()[0].value,
            getCode = $(this).attr('data-code');
        $.ajax({
            url: '../controls/add-cms.php',
            type: 'POST',
            data: {name: getVal, code: getCode},
            success: function(response) {
                if(response == 'success') {
                    $('.'+ getCode).append('<li>'+ getVal +'</li>');
                    $('.cms-form-add-cms').find('input').val('');
                } else {
                    alert('Name already exist');
                }
            }
        });
    });

    $('.btn-done-trans').click(function() {
        var getIds = $('.trans-id').attr('data-transaction-affted');
        $(this).text('Finishing transaction...');
        $.ajax({
            url: '../controls/finish-transaction.php',
            type: 'POST',
            data: {ids: getIds},
            success: function(result) {
                if(result == 'user-home') {
                    $(location).attr('href', 'user-home');
                }
            }
        });
    });

    $('.search-generate-report').submit(function(e) {
        e.preventDefault();
        var getRange = $(this).serializeArray()[0].value;
        $.ajax({
            url: '../controls/generate-report-search.php',
            type: 'POST',
            data: {dateRange: getRange},
            success: function(result) {
                $('.generate-report-ajax').html(result);
            }
        });
    });

    $('.modal-content barcode-form').submit(function(e) {
        e.preventDefault();
        alert(123);
    });

});
