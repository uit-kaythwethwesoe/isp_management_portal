$(function ($) {
    "use strict";

    jQuery(document).ready(function () {

        let main_url = $('#main_url').val();



        // Billpay view Ajax modal
        $('.billpay_view').on('click', function (event) {
            event.preventDefault();
            let id = $(this).attr('data-id');
            console.log(id);

            $.ajax({
                url: main_url + "/user/bill-pay/view/" + id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#fname').text(data.bill.user.name);
                    $('#username').text(data.bill.user.username);
                    $('#email').text(data.bill.user.email);
                    $('#phone').text(data.bill.user.phone);
                    $('#address').text(data.bill.user.address);
                    $('#country').text(data.bill.user.country);
                    $('#city').text(data.bill.user.city);
                    $('#zipcode').text(data.bill.user.zipcode);

                    $('#packname').text(data.bill.package.name);
                    $('#packspeed').text(data.bill.package.speed);
                    $('#packprice').text(data.bill.package.price);
                    $('#packtime').text(data.bill.package.time);
                    $('#paydate').text(data.bill.fulldate);
                    $('#currency_sign').text(data.bill.currency_sign);
                    $('#method').text(data.bill.method);
                    $('#attendance_id').text(data.bill.attendance_id);
                    $('#txn_id').text(data.bill.txn_id);
                }
            })
        });


        // message show sweet alert
        const Toast2 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        function success(message) {
                Toast2.fire({
                    icon: 'success',
                    title: message
                })
        };
        function error(message) {
                Toast2.fire({
                    icon: 'error',
                    title: message
                })
        };



        // plan payment gateway check js
        $(document).on('click','.plan_payment_gateway_check',function(){
            $('.plan_payment_gateway_check').removeClass('active');
            $(this).addClass('active');
            $('#plan_payment_id').val($(this).attr('data-href'));
            let plan_check = $(this).attr('id');
            if(plan_check ==  'Paypal'){
                $('#plan_order_submit').attr('action',$('#plan_paypal').val());
                $('.payment_show_check').addClass('d-none');
            }else{
                $('.payment_show_check').removeClass('d-none');
                $('#plan_order_submit').attr('action',$('#plan_stripe').val());
            }
        });


        // Product payment geteway 
        $(document).on('click','.product_payment_gateway_check',function(){
            let gateway_check = $(this).attr('id');
            $('.product_payment_gateway_check').removeClass('active');
            $(this).addClass('active');
            if(gateway_check == 'Paypal'){
                $('#payment_gateway_check').attr('action',$('#product_paypal').val());
                $('.payment_show_check').addClass('d-none');
                $('.payment_show_check input').prop('required',false);
            }else{
                $('#payment_gateway_check').attr('action',$('#product_stripe').val());
                $('.payment_show_check').removeClass('d-none');
                $('.payment_show_check input').prop('required',true);
            }
            $('#payment_gateway').val($(this).attr('data-href'));
        })

        // product quintity select js

        $(document).on('click', '.subclick', function () {
            let current_qty = parseInt($('.cart-amount').val());
            if (current_qty > 1) {
                $('.cart-amount').val(current_qty - 1);
            } else {
                error('Minumum Quantity Must Be 1');
            }

        })


        $(document).on('click', '.addclick', function () {
            let current_stock = parseInt($('#current_stock').val());
            let current_qty = parseInt($('.cart-amount').val());
            if (current_qty < current_stock) {
                $('.cart-amount').val(current_qty + 1);
            } else {
                error('Product Quantity Maximum ' + current_stock);
            }
        })

        $(document).on('keyup', '.cart-amount', function () {
            let current_stock = parseInt($('#current_stock').val());
            let key_val = parseInt($(this).val());

            if (key_val > current_stock) {
                error('Product Maximum Quantity ' + current_stock);
                $('.cart-amount').val(current_stock);
            }
            if (key_val <= 0) {
                $('.cart-amount').val(1);
                error('Product Minimum Quantity' + 1);
            }
            if (key_val > 0 && key_val < current_stock) {
                $('.cart-amount').val(key_val);
            }

        })

     
        // ============== add to cart js start =======================//
        $(document).on('click', '.cart-link', function (event) {
            event.preventDefault();
            let cartUrl = $(this).attr('data-href');
            let cartItemCount = $('.cart-amount').val();
            if (typeof cartItemCount === 'undefined') {
                cartItemCount = 1;
            }
            $.get(cartUrl + ',,,' + cartItemCount, function (res) {
                if (res.message) {
                    success(res.message);
                    $('.cart-amount').val(1);
                } else {
                    error(res.error)
                    $('.cart-amount').val(1);
                }
            })
        });
        // show cart quintity 
        function getCartQty() {
            let get_qty_url = $('#cart-count').attr('data-target');
            $.get(get_qty_url, function (qty) {
                $('.cart-count').html(qty);
            });
        }
        // ============== add to cart js end =======================//

        //=============== cart update js start ==========================//

        $(document).on('click', '#cart_update', function () {
            $(this).prop('disabled', true);
            let cartqty = [];
            let cartprice = [];
            let cartproduct = [];
            let cartUpdateUrl = $(this).attr('data-href');

            $(".quantity").each(function () {
                cartqty.push($(this).val());
            })

            $("span.cart_price").each(function () {
                cartprice.push(parseFloat($(this).text()));
            });

            $(".product_id").each(function () {
                cartproduct.push($(this).val());
            });

            let formData = new FormData();
            let x = 0;
            for (x = 0; x < cartqty.length; x++) {
                formData.append('qty[]', cartqty[x]);
                formData.append('cartprice[]', cartprice[x]);
                formData.append('product_id[]', cartproduct[x]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: cartUpdateUrl,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.message) {
                        let cartPriceUpdate = [];
                        $(".cart_price").each(function () {
                            cartPriceUpdate.push(parseFloat($(this).text()));
                        });
                        $('.cart-total-view').text(data.total);
                        $('#cart_update').prop('disabled', false);
                        
                        if (data.count) {
                            $('.cart-item-view').text(data.count);
                            $('.cart-total-view').text(data.total);
                        }
                        success(data.message);
                    } else {
                        error(data.error);
                    }

                }
            });
        })
        //================= cart update js end ==========================//

        // ================ cart item remove js start =======================//

        $(document).on('click','.item-remove',function(){
        
            let removeItem = $(this).attr('rel');
            let removeItemUrl = $(this).attr('data-href');
            $.get(removeItemUrl,function(res){
                if(res.message){
                    success(res.message);
                    getCartQty();
                    if(res.count == 0){
                        $(".total-item-info").remove();
                        $(".cart-table").remove();
                        $(".cart-middle").remove();
                        $('.remove_before').html( `
                        <div class="container">
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-light py-5 text-center">
                                <h3 class="text-uppercase">Cart is empty!</h3>
                            </div>
                        </div>
                        </div>
                    </div>
                        `
                        );
                    }
                    $('.cart-item-view').text(res.count);
                    $('.cart-total-view').text(res.total);
                    $('.remove'+removeItem).remove(); 
                }else{
                    error(res.error);
                }
            
            });
        
        });


        // ================ cart item remove js start =======================//


        //================== shipping charge js =========================//
        
        $(document).on('click','.shipping-charge',function(){
            let cost = parseFloat($(this).attr('data'));
            let grand_total = parseFloat($('.grand_total').attr('data'));
            let new_total = grand_total + cost;
            $('.grand_total').html(parseFloat(new_total).toFixed(2));
            $('.shipping_cost').html(cost);
        });

        $(document).on('change','#change_address',function(){
            if($(this).is(':checked')){
                $('#shipping-area').removeClass('d-none');
            }else{
                $('#shipping-area').addClass('d-none');
            }
        })
        //================== shipping charge js =========================//

        //   magnific popup activation Strat
        $('.video-play-btn, .play-video').magnificPopup({
            type: 'video'
        });

        $('.img-popup').magnificPopup({
            type: 'image'
        });
        //   magnific popup activation End

        // Hero Area Slider
        var $mainSlider = $('.intro-carousel');
        $mainSlider.owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            smartSpeed: 2000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });

        // testimonial_slider 
        var $testimonial_slider = $('.testimonial-slider');
        $testimonial_slider.owlCarousel({
            loop: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplay: false,
            margin: 0,
            autoplayTimeout: 6000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
        // Pricing Plan slider Start
        var $pricing_slider = $('.pricing-slider');
        $pricing_slider.owlCarousel({
            loop: true,
            nav: true,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            dots: true,
            autoplay: false,
            autoplayTimeout: 5000,
            smartSpeed: 2000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });

    });

    // back to top Start
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });
    // back to top End

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        var nav = $('.mainmenu-area');

        if ($window.scrollTop() > 48) {
            nav.addClass('nav-fixed');
        } else {
            nav.removeClass('nav-fixed');
        }


        // back to top show / hide
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {
        // Preloader
        var preLoder = $("#preloader");
        preLoder.addClass('hide');
        var backtoTop = $('.back-to-top')

        // back to top
        var backtoTop = $('.bottomtotop')
        backtoTop.fadeOut(100);

    });


    if (document.body.dataset.notification == undefined) {
        return false;
    } else {

        var data = JSON.parse(document.body.dataset.notificationMessage);
        var msg = data.messege;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        switch (data.alert) {
            case 'info':
                Toast.fire({
                    icon: 'info',
                    title: msg
                })
                break;
            case 'success':
                Toast.fire({
                    icon: 'success',
                    title: msg
                })
                break;
            case 'warning':
                Toast.fire({
                    icon: 'warning',
                    title: msg
                })
                break;
            case 'error':
                Toast.fire({
                    icon: 'error',
                    title: msg
                })
                break;
        }
    };
});