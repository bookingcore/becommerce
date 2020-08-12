jQuery(function ($) {
    $.fn.bravoAutocomplete = function (options) {
        return this.each(function () {
            var $this = $(this);
            var main = $(this).closest(".smart-search");
            var textLoading = options.textLoading;
            main.append('<div class="bravo-autocomplete on-message"><div class="list-item"></div><div class="message">'+textLoading+'</div></div>');
            $(document).on("click.Bst", function(event){
                if (main.has(event.target).length === 0 && !main.is(event.target)) {
                    main.find('.bravo-autocomplete').removeClass('show');
                } else {
                    main.find('.bravo-autocomplete').addClass('show');
                }
            });
            if (options.dataDefault.length > 0) {
                var items = '';
                for (var index in options.dataDefault) {
                    var item = options.dataDefault[index];
                    items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="icofont-location-pin"></i> ' + item.title + ' </div>';
                }
                main.find('.bravo-autocomplete .list-item').html(items);
                main.find('.bravo-autocomplete').removeClass("on-message");
            }
            var requestTimeLimit;
            $this.keyup(function () {
                main.find('.bravo-autocomplete').addClass("on-message");
                main.find('.bravo-autocomplete .message').html(textLoading);
                main.find('.child_id').val("").trigger("change");
                var query = $(this).val();
                clearTimeout(requestTimeLimit);
                if(query.length === 0){
                    if (options.dataDefault.length > 0) {
                        var items = '';
                        for (var index in options.dataDefault) {
                            var item = options.dataDefault[index];
                            items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="icofont-location-pin"></i> ' + item.title + ' </div>';
                        }
                        main.find('.bravo-autocomplete .list-item').html(items);
                        main.find('.bravo-autocomplete').removeClass("on-message");
                    }
                    return;
                }
                requestTimeLimit = setTimeout(function () {
                    $.ajax({
                        url: options.url,
                        data: {
                            search: query,
                        },
                        dataType: 'json',
                        type: 'get',
                        beforeSend: function() {
                        },
                        success: function (res) {
                            if(res.status === 1){
                                var items = '';
                                for (var ix in res.data) {
                                    var item = res.data[ix];

                                    items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="icofont-location-pin"></i> ' + get_highlight(item.title,query) + ' </div>';
                                }
                                main.find('.bravo-autocomplete .list-item').html(items);
                                main.find('.bravo-autocomplete').removeClass("on-message");
                            }
                            if(res.message.length > 0){
                                main.find('.bravo-autocomplete').addClass("on-message");
                                main.find('.bravo-autocomplete .message').html(res.message);
                            }
                        }
                    })
                }, 700);
                function get_highlight(text, val) {
                    return text.replace(
                        new RegExp(val + '(?!([^<]+)?>)', 'gi'),
                        '<span class="h-line">$&</span>'
                    );
                }
                main.find('.bravo-autocomplete').addClass('show');
            });
            main.find('.bravo-autocomplete').on('click','.item',function () {
                console.log($(this).attr('data-id'));
                var id = $(this).attr('data-id'),
                    text = $(this).attr('data-text');
                if(id.length > 0 && text.length > 0){
                    text = text.replace(/-/g, "");
                    text = text.substring(1);
                    main.find('.parent_text').val(text).trigger("change");
                    main.find('.child_id').val(id).trigger("change");
                }else{
                    console.log("Cannot select!")
                }
                setTimeout(function () {
                    main.find('.bravo-autocomplete').removeClass('show');
                },100)
            });
        });
    };
});

jQuery(function ($) {

    function parseErrorMessage(e){
        var html = '';
        if(e.responseJSON){
            if(e.responseJSON.errors){
                return Object.values(e.responseJSON.errors).join('<br>');
            }
        }
        return html;
    }
    $(".bravo-list-tour").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 4,
            loop: false,
            margin: 15,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    });

    $(".bravo-list-space").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 3,
            loop: false,
            margin: 15,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    });

    $(".bravo_fullHeight").each(function () {
        var height = $(document).height();
        if ($(document).find(".bravo-admin-bar").length > 0) {
            height = height - $(".bravo-admin-bar").height();
        }
        $(this).css('min-height', height);
    });

    // Date Picker Range
    $('.form-date-search').each(function () {
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_out_input = $('.check-out-input', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            singleDatePicker: false,
            autoApply: true,
            disabledPast: true,
            dateFormat: Bravo.date_format,
            customClass: '',
            widthSingle: 300,
            onlyShowCurrentMonth: true,
        };
        if (typeof  locale_daterangepicker == 'object') {
            options.locale = locale_daterangepicker;
        }
        check_in_out.daterangepicker(options,
            function (start, end, label) {
                check_in_input.val(start.format(Bravo.date_format));
                check_in_render.html(start.format(Bravo.date_format));
                check_out_input.val(end.format(Bravo.date_format));
                check_out_render.html(end.format(Bravo.date_format));
                check_in_out.trigger('daterangepicker_change', [start, end]);
                if (window.matchMedia('(max-width: 767px)').matches) {
                    $('.render', parent).show();
                    $('.check-in-wrapper span', parent).show();
                }
            });
        date_wrapper.click(function (e) {
            check_in_out.trigger('click');
        });
    });

    // Date Picker
    $('.date-picker').each(function () {
        $(this).daterangepicker({
            "singleDatePicker": true,
            locale: {
                format: Bravo.date_format
            }
        });
    });

    //Review
    $('.review-form .review-items .rates .fa').each(function () {
        var list = $(this).parent(),
            listItems = list.children(),
            itemIndex = $(this).index(),
            parentItem = list.parent();
        $(this).hover(function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('hovered');
                } else {
                    break;
                }
            }
            $(this).click(function () {
                for (var i = 0; i < listItems.length; i++) {
                    if (i <= itemIndex) {
                        $(listItems[i]).addClass('selected');
                    } else {
                        $(listItems[i]).removeClass('selected');
                    }
                }
                parentItem.children('.review_stats').val(itemIndex + 1);
            });
        }, function () {
            listItems.removeClass('hovered');
        });
    });

    //Login
    $('.bravo-form-login [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-login');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': Bravo.routes.login,
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'remember': form.find('input[name=remember]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
                'redirect': form.find('input[name=redirect]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for(var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-'+item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                }
                if (data.redirect !== undefined && data.redirect) {
                    window.location.href = data.redirect
                }
            }
        });
    })
    $('.bravo-form-register [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-register');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url':  Bravo.routes.register,
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'first_name': form.find('input[name=first_name]').val(),
                'last_name': form.find('input[name=last_name]').val(),
                'term': form.find('input[name=term]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for(var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-'+item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                }
                if (data.redirect !== undefined) {
                    window.location.href = data.redirect
                }
            },
            error:function (e) {
                form.find('.icon-loading').hide();
                if(typeof e.responseJSON !== "undefined" && typeof e.responseJSON.message !='undefined'){
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + e.responseJSON.message + '</div>');
                }
            }
        });
    })
    $('#register').on('show.bs.modal', function (event) {
        $('#login').modal('hide')
    })
    $('#login').on('show.bs.modal', function (event) {
        $('#register').modal('hide')
    });

    var onSubmitSubscribe = false;
    //Subscribe box
    $('.bravo-subscribe-form').submit(function (e) {
        e.preventDefault();

        if (onSubmitSubscribe) return;

        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }

                if (json.status) {
                    me.find('input[name=email]').val('');
                }

            },
            error: function (e) {
                console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if(parseErrorMessage(e)){
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                }else
                if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });

    //Menu
    $(".bravo-more-menu").click(function () {
        $(this).trigger('bravo-trigger-menu-mobile');
    });
    $(".bravo-menu-mobile .b-close").click(function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    });
    $(document).on("click",".bravo-effect-bg",function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    })
    $(document).on("bravo-trigger-menu-mobile",".bravo-more-menu",function () {
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(".bravo-menu-mobile").addClass("active");
            $('body').css('overflow','hidden').append("<div class='bravo-effect-bg'></div>");
        }else{
            $(".bravo-menu-mobile").removeClass("active");
            $("body").css('overflow','initial').find(".bravo-effect-bg").remove();
        }
    });
    $(".bravo-menu-mobile .g-menu ul li .fa").click(function (e) {
        e.preventDefault();
        $(this).closest('li').toggleClass('active');
    });
    $(".bravo-menu-mobile").each(function () {
        var h_profile = $(this).find(".user-profile").height();
        var h1_main = $(window).height();
        $(this).find(".g-menu").css("max-height", h1_main - h_profile - 15);
    });

    $(".bravo-more-menu-user").click(function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").addClass("active");
        $("body").css('overflow','hidden').append("<div class='bravo-effect-user-bg'></div>");
    });
    $(document).on("click",".bravo-effect-user-bg,.bravo-close-menu-user",function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").removeClass("active");
        $('body').css('overflow','initial').find(".bravo-effect-user-bg").remove();
    })

    $('[data-toggle="tooltip"]').tooltip();
    $('.dropdown-toggle').dropdown();

    $('.select-guests-dropdown .btn-minus').click(function(e){
        e.stopPropagation();
        var parent = $(this).closest('.form-select-guests');
        var input = parent.find('.select-guests-dropdown [name='+$(this).data('input')+']');
        var min = parseInt(input.attr('min'));
        var old = parseInt(input.val());

        if(old <= min){
            return;
        }
        input.val(old-1);
        $(this).next().html(old-1);
        updateGuestCountText(parent);
    });

    $('.select-guests-dropdown .btn-add').click(function(e){
        e.stopPropagation();
        var parent = $(this).closest('.form-select-guests');
        var input = parent.find('.select-guests-dropdown [name='+$(this).data('input')+']');
        var max = parseInt(input.attr('max'));
        var old = parseInt(input.val());

        if(old >= max){
            return;
        }
        input.val(old+1);
        $(this).prev().html(old+1);
        updateGuestCountText(parent);
    });

    function updateGuestCountText(parent){
        var adults = parseInt(parent.find('[name=adults]').val());
        var children = parseInt(parent.find('[name=children]').val());

        var adultsHtml = parent.find('.render .adults .multi').data('html');
        console.log(parent,adultsHtml);
        parent.find('.render .adults .multi').html(adultsHtml.replace(':count',adults));

        var childrenHtml = parent.find('.render .children .multi').data('html');
        parent.find('.render .children .multi').html(childrenHtml.replace(':count',children));
        if(adults > 1){
            parent.find('.render .adults .multi').removeClass('d-none');
            parent.find('.render .adults .one').addClass('d-none');
        }else{
            parent.find('.render .adults .multi').addClass('d-none');
            parent.find('.render .adults .one').removeClass('d-none');
        }

        if(children > 1){
            parent.find('.render .children .multi').removeClass('d-none');
            parent.find('.render .children .one').addClass('d-none');
        }else{
            parent.find('.render .children .multi').addClass('d-none');
            parent.find('.render .children .one').removeClass('d-none').html(parent.find('.render .children .one').data('html').replace(':count',children));
        }

    }

    $('.select-guests-dropdown .dropdown-item-row').click(function(e){
        e.stopPropagation();
    });

    $(".smart-search .smart-search-location").each(function () {
        var $this = $(this);
        var string_list = $this.attr('data-default');
        var default_list = [];
        if(string_list.length > 0){
            default_list = JSON.parse(string_list);
        }
        var options = {
            url: Bravo.url+'/location/search/searchForSelect2',
            dataDefault: default_list,
            textLoading: $this.attr("data-onLoad"),
        };
        $this.bravoAutocomplete(options);
    });

    $(document).on("click",".service-wishlist",function(e){
        var $this = $(this);
        if (!$this.hasClass('active')){
            e.preventDefault();
            let w_class = $this.attr('class');
            let id = $this.attr('data-id');
            $.ajax({
                url:  Bravo.url+'/user/wishlist',
                data: {
                    object_id: id,
                    object_model: $this.attr("data-type"),
                },
                dataType: 'json',
                type: 'POST',
                beforeSend: function() {
                    $this.addClass("loading").tooltip('hide');
                },
                success: function (res) {
                    $this.attr('class',w_class + ' ' + res.class).attr('data-original-title', res.title).tooltip('show').find('.btn-text').text(res.title);
                    $(`.service-wishlist[data-id=${id}]`).attr('class',w_class + ' ' + res.class).attr('data-original-title', res.title);
                    let count = $('.user-wish-list-count');
                    count.html(parseInt(count.text()) + 1);
                },
                error:function (e) {
                    if(e.status === 401){
                        $this.removeClass("loading");
                        $('#login').modal('show');
                    }
                }
            })
        } else {
            return;
        }
    });
});

jQuery(function ($) {
    $('.testimonial-list').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
        prevArrow: '<div class="mf-left-arrow slick-arrow" style="display: block;"><i class="icon-chevron-left"></i></div>',
        nextArrow: '<div class="mf-right-arrow slick-arrow" style="display: block;"><i class="icon-chevron-right"></i></div>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                }
            },
        ]
    });

    $('.bravo-home-sliders').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style=""><i class="icon-chevron-left"></i></button>',
        nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style=""><i class="icon-chevron-right"></i></button>',
    });

    let w_width = $(window).width();
    let w_item = function (item = 6) {
        if (w_width <= 1199){
            item = 4;
        }
        if (w_width <= 991){
            item = 3
        }
        if (w_width < 767){
            item = 2
        }
        return item;
    };
    $('.bravo_product-list.style-1 .products, .bravo_ProductInCategories .products, .product-related .products').slick({
        infinite: false,
        arrows: false,
        dots: true,
        responsiveClass:true,
        slidesToShow: w_item(),
        slidesToScroll: w_item(),
        responsive:{
            0:{
                items:2,
            },
            767:{
                items:3,
            },
            992:{
                items:4,
            },
            1200:{
                items:6,
            }
        }
    });

    $('.product-categories li .cat-menu-close').click(function () {
        if ($(this).parent().hasClass('opened')){
            $(this).next().stop().slideUp('normal').parent().removeClass('opened');
        } else {
            $(this).next().stop().slideDown('normal').parent().addClass('opened');
        }
    });
    $('#mf-catalog-banners').slick({
        prevArrow: '<span class="icon-chevron-left slick-prev-arrow slick-arrow"></span>',
        nextArrow: '<span class="icon-chevron-right slick-next-arrow slick-arrow"></span>',
    });
});

jQuery(function ($) {
    $('.category-select').change(function(){
        $("#text_change").html($('.category-select option:selected').text());
        $(this).css('width', $(".select_change").width() + 10 + 'px');
    });

    $(document).on('click','.quantity-input-group span',function () {
        let input = $(this).parent().find('input[name=quantity]');
        let max = input.attr('max');
        let has_currentVariation = Object.keys(Bravo.currentVariation).length > 0;
        let quantity = (has_currentVariation && Bravo.currentVariation.variations.quantity !== null) ? Bravo.currentVariation.variations.quantity - Bravo.currentVariation.variations.sold : null;
        let v_quantity = (has_currentVariation) ? quantity : max;
        if ($(this).hasClass('minus')){
            input.val( (parseInt(input.val()) <= 1) ? 1 : parseInt(input.val()) - 1 );
        } else {
            if (v_quantity !== null){
                input.val( parseInt(input.val()) >= v_quantity ? v_quantity : parseInt(input.val()) + 1 );
            } else {
                input.val( parseInt(input.val()) + 1 );
            }
        }
    });

    let navigation_mobile = $('.mf-navigation-mobile .navigation-list > a').not($('.navigation-mobile_home'));
    navigation_mobile.click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.mf-els-modal-mobile').removeClass('open');
        } else {
            let id = $(this).attr('data-id');
            navigation_mobile.removeClass('active');
            $('.mf-els-item').removeClass('current');
            $(this).addClass('active');
            $('.mf-els-modal-mobile').addClass('open');
            $('#'+id).addClass('current');
        }
    });
    $('.close-mobile-nav, .close-cart-mobile').click(function () {
        $(this).closest('.mf-els-modal-mobile').removeClass('open');
        $('.mf-navigation-mobile .navigation-list a').not($('.navigation-mobile_home')).removeClass('active');
    });
    $('.menu-item-has-children > a, .menu-item-has-children .menu-item-mega > a').click(function (e) {
        e.preventDefault();
        let p_item = $(this).closest('.menu-item-has-children');
        let p_item_child = $(this).parent().attr('class');
        if (p_item.hasClass('active')){
            p_item.removeClass('active').find('.dropdown-submenu').stop().slideUp();
        } else {
            if (p_item_child !== 'menu-item-mega'){
                $('.menu-item-has-children').removeClass('active');
                $('.dropdown-submenu').stop().slideUp();
                p_item.addClass('active').find('.dropdown-submenu').stop().slideDown();
            } else {
                if ($(this).hasClass('active')){
                    $(this).removeClass('active').parent().find('.sub-menu').stop().slideUp();
                } else {
                    $(this).closest('.mega-menu-content').find('.menu-item-mega > a').removeClass('active');
                    $(this).closest('.mega-menu-content').find('.menu-item-mega .mega-menu-submenu .sub-menu').stop().slideUp();
                    $(this).addClass('active').parent().find('.mega-menu-submenu .sub-menu').stop().slideDown();
                }
            }
        }
    });
});

jQuery(function ($) {
    $('.quantity-number button').click(function (e) {
        e.preventDefault();
        let $this = $(this);
        let input = $this.parent().find('input');
        let price = $this.closest('.cart-item').find('.price').attr('data-price');
        let total = $this.closest('.cart-item').find('.total');
        let stock = input.attr('data-stock');


        if ($this.hasClass('down')){
            input.val( parseInt(input.val()) <= 1 ? 1 : parseInt(input.val()) - 1  );
        } else {
            if (!isNaN(parseInt(stock))){
                input.val( (parseInt(input.val()) >= parseInt(stock)) ? stock : parseInt(input.val()) + 1 );
            } else {
                input.val( parseInt(input.val()) + 1 );
            }
        }
        total.html( window.bravo_format_money( parseFloat(price) * parseInt(input.val()) ) );
    });

    $('.quantity-number input').keyup(function () {
        let $this = $(this);
        let price = $this.closest('.cart-item').find('.price').attr('data-price');
        let total = $this.closest('.cart-item').find('.total');
        let stock = $this.attr('data-stock');
        if ( parseInt($this.val()) <= 1 || $this.val() === '' ) $this.val(1);
        if ( !isNaN(parseInt(stock)) && parseInt($this.val()) >= parseInt(stock) ) $this.val(stock);
        if ($this.val() > 0){
            total.html( window.bravo_format_money(parseFloat(price) * parseInt($this.val())) );
        }
    });
    $(".ps-select").select2();
    $('.mf-product-quick-view').click(function (e) {
        e.preventDefault();
        let $this = $(this);
        let product = $(this).data('product');
        let quickView = $('.mf-quick-view-modal');
        $.ajax({
            url: bookingCore.url + '/product/quick_view/' + product.id,
            method:'POST',
            beforeSend: function () {
                $this.tooltip('hide');
                quickView.addClass('loading').fadeIn();
            },
            success: function (data) {
                quickView.removeClass('loading').addClass('loaded');
                $('.product-modal-content').html(data).css('display','block');
                $('.product-gallery').slick({
                    prevArrow: '<span class="icon-chevron-left slick-prev-arrow"></span>',
                    nextArrow: '<span class="icon-chevron-right slick-next-arrow"></span>',
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        })
    });
    $(document).on('click','.close-modal, .mf-modal-overlay',function (e) {
        e.preventDefault();
        $('.mf-quick-view-modal').fadeOut();
        $('.product-modal-content').html('');
    });
    $(document).on('click','.tawcvs-swatches .swatch',function (e) {
        let $this = $(this);
        let single_variation_wrap = $('.single_variation_wrap');
        let add_to_cart = $('.bravo_add_to_cart');
        let attr_class = $this.attr('class').split(' ')[1];
        let name = $this.attr('data-name');
        let nameDefault = $this.closest('tr').find('.mf-attr-value').attr('data-default');
        let term_id = $this.attr('data-get_term');
        if ($this.hasClass('selected')){
            $this.removeClass('selected');
            $this.closest('tr').find('.mf-attr-value').attr('data-term','0').html(nameDefault);
        } else {
            $this.parent().find('.'+attr_class).removeClass('selected');
            $this.addClass('selected');
            $this.closest('tr').find('.mf-attr-value').attr('data-term',term_id).html(name);
        }

        let term_list = [];
        $('.variations .mf-attr-value').each(function () {
            if (parseInt($(this).attr('data-term')) > 0){
                term_list.push(parseInt($(this).attr('data-term')));
                term_list.sort(function (a, b) {
                    return a - b;
                });
                return term_list;
            }
        })
        if (Bravo.variations.length > 0){
            let variable_error = true;

            Bravo.variations.forEach(function (i) {
                if (term_list.join() === i.term_id.join()){
                    variable_error = false;
                    Bravo.currentVariation = i;
                    //check stock status
                    let $stock = ''; let $in_stock = true;
                    if (parseInt(i.variations.is_manage_stock) > 0){
                        if (i.variations.stock_status === 'in'){
                            let quantity = (i.variations.sold) ? i.variations.quantity - i.variations.sold : i.variations.quantity;
                            $stock = i18n.num_stock.replace('__num__',quantity);
                        }
                    } else {
                        $stock = i18n.in_stock;
                    }
                    if (i.variations.stock_status === 'out'){
                        $stock = i18n.out_stock;
                        $in_stock = false;
                    }

                    if (!isNaN(parseInt(i.variations.price)) && parseInt(i.variations.price) > 0){
                        single_variation_wrap.addClass('active');
                        single_variation_wrap.find('.variation-price').attr('data-price',i.variations.price).html(window.bravo_format_money(i.variations.price));
                        single_variation_wrap.find('.variation-stock').removeClass('out-of-stock in_stock').addClass( $in_stock ? 'in_stock' : 'out-of-stock' ).find('.stock-status').html($stock);
                        (single_variation_wrap.find('.variation-stock').hasClass('out-of-stock')) ? add_to_cart.attr('disabled','disabled') : add_to_cart.removeAttr('disabled');
                    }
                } else {
                    return false;
                }
            })
            if (variable_error === true){
                single_variation_wrap.removeClass('active');
                add_to_cart.attr('disabled','disabled');
            }
        }
    })
    $('.user-mini-cart').click(function (e) {
        let width = $(window).width();
        if (width <= 991){
            e.preventDefault();
            $('.navigation-mobile_cart').click();
        }
    });
    $('.mf-filter-mobile').click(function (e) {
        e.preventDefault();
        $('.col-bravo-filter, .bravo-filter').addClass('active');
    })
    $('.mf-catalog-close-sidebar').click(function () {
        $('.col-bravo-filter, .bravo-filter').removeClass('active');
    })
});

jQuery(function ($) {
    //Compare
    let compare_box = $('.bravo_compare_box');
    let compare_count = $('.user-compare-count');
    let compare_button = function(id){return $(`.mf-compare-button[data-id=${id}]`);}

    $('.user-compare-list').click(function () {
        compare_box.addClass('active');
    });
    $(document).on('click','.mf-compare-button',function (e) {
        e.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-id');
        if ($this.hasClass('browse')){
            $this.tooltip('hide');
            compare_box.addClass('active');
        } else {
            $.ajax({
                url: bookingCore.url + '/product/compare',
                method: 'POST',
                data: {id: id},
                beforeSend: function () {
                    $this.tooltip('hide').removeClass('browse').addClass('loading');
                },
                success:function (data) {
                    compare_button(id).attr('data-original-title',i18n.browse_compare).removeClass('loading').addClass('browse').find('.btn-text').text(i18n.browse_compare);
                    compare_count.text(data.count);
                    compare_box.addClass('active').find('.compare-list').html(data.view);
                }
            })
        }
    })
    $('.compare_close, .compare_overlay').click(function () {
        $(this).closest('.bravo_compare_box').removeClass('active');
    })
    $(document).on('click','.remove_compare',function (e) {
        e.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-id');
        $.ajax({
            url: bookingCore.url + '/product/remove_compare',
            method:'POST',
            data: {id: id},
            beforeSend: function () {
                $this.addClass('loading');
            },
            success: function (data) {
                $this.removeClass('loading');
                compare_button(id).attr('data-original-title',i18n.add_compare).removeClass('browse').find('.btn-text').text(i18n.add_compare);
                compare_count.text(data.count);
                compare_box.find('.compare-list').html(data.view);
            }
        })
    })
})
