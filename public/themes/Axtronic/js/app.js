$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content'),
        'Accept':'application/json'
    }
});
window.bc_format_money =  function($money) {
    if (!$money) {

    }
    $money            = bc_number_format($money, BC.booking_decimals, BC.decimal_separator, BC.thousand_separator);
    var $symbol       = BC.currency_symbol;
    var $money_string = '';

    switch (BC.currency_position) {
        case "right":
            $money_string = $money + $symbol;
            break;
        case "left_space":
            $money_string = $symbol + " " + $money;
            break;

        case "right_space":
            $money_string = $money + " " + $symbol;
            break;
        case "left":
        default:
            $money_string = $symbol + $money;
            break;
    }
    return $money_string;
}
window.bc_number_format = function (number, decimals, dec_point, thousands_sep) {


    number         = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n          = !isFinite(+number) ? 0 : +number,
        prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s          = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}
// dropdown
$('.bc-dropdown .bc-dropdown-btn').on('click',function(){
    $(this).parent().closest('.bc-dropdown').toggleClass('show');
})
$('.bc-dropdown .bc-close').on('click',function(){
    $(this).parent().closest('.bc-dropdown').removeClass('show');
})
function ajax_error_to_string(e){
    if(typeof e.responseJSON !== 'undefined'){
        if(e.responseJSON.errors){
            var html = [];
            for(var k in e.responseJSON.errors){
                html.push(e.responseJSON.errors[k].join("<br/>"));
            }

            return html.join("<br/>");
        }

        if(e.responseJSON.message){
            return e.responseJSON.message;
        }
    }
}
$('.bc-form-login').on('submit',function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize()
    $.ajax({
        'url':  BC.routes.login,
        'data': data,
        'type': 'POST',
        beforeSend: function () {
            form.addClass('loading');
            form.find('.error').hide();
            form.find('.icon-loading').css("display", 'inline-block');
        },
        success: function (data) {
            form.removeClass('loading')
            form.find('.icon-loading').hide();
            if(typeof data =='undefined') return;
            if (data.error === true) {
                if (data.errors !== undefined) {
                    for(var item in data.errors) {
                        var msg = data.errors[item];
                        form.find('.error-'+item).show().text(msg[0]);
                    }
                }
                if (data.message !== undefined) {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + data.message + '</div>');
                }
            }
            if (typeof data.redirect !== 'undefined' && data.redirect) {
                window.location.href = data.redirect
            }
            if(typeof data.two_factor === 'undefined' || !data.two_factor){
                var redirect = form.find('[name=redirect]').val();
                console.log(redirect);
                if(redirect){
                    window.location.href = redirect;
                }else{
                    window.location.reload();
                }
            }
        },
        error:function (e){
            form.removeClass('loading')
            var html = ajax_error_to_string(e);
            if(html){
                form.find('.message-error').show().html('<div class="alert alert-danger">' + html + '</div>');
            }
        }
    });
    return false;
});
$('.bc-form-register').on('submit',function (e) {
    e.preventDefault();
    let form = $(this);
    var data = form.serialize()
    $.ajax({
        'url':  BC.routes.register,
        'data': data,
        'type': 'POST',
        beforeSend: function () {
            form.addClass('loading');
            form.find('.error').hide();
            form.find('.icon-loading').css("display", 'inline-block');
        },
        success: function (data) {
            form.removeClass('loading')
            form.find('.icon-loading').hide();
            if(typeof data =='undefined') return;
            if (data.error === true) {
                if (data.errors !== undefined) {
                    for(var item in data.errors) {
                        var msg = data.errors[item];
                        form.find('.error-'+item).show().text(msg[0]);
                    }
                }
            }
            if (typeof data.redirect !== 'undefined' && data.redirect) {
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
window.bravo_handle_error_response = function(e){
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            break;
    }
};
// Cart

$('.axtronic_form_add_to_cart').on('submit',function(e){
    e.preventDefault();
    var me = $(this);
    me.addClass('loading');
    $.ajax({
        url:'/cart/addToCart',
        data:me.serialize(),
        type:'post',
        dataType:'json',
        success:function(json){
            me.removeClass('loading');
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.message){
                BCApp.showAjaxMessage(json);
            }
        },
        error:function(err){
            bravo_handle_error_response(err);
            me.removeClass('loading');
        }
    })
})
$(document).on('click','.axtronic_delete_cart_item',function(e){
    e.preventDefault();
    var c = confirm("Do you want to delete this cart item?");
    if(!c) return;
    var removeElement = $(this).data('remove');
    var me = $(this);
    var id = $(this).data('id');
    $.ajax({
        url:'/cart/remove_cart_item',
        data:{
            id:id
        },
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.reload){
                window.location.reload();
            }
            if(json.message){
                BCApp.showAjaxMessage(json);
            }

            if(typeof removeElement !='undefined'){
                me.closest(removeElement).remove();
            }
        },
        error:function(err){
            bravo_handle_error_response(err);
            console.log(err)
        }
    })
})
$(document).on('click','.cart-item-qty .up',function (e) {
    e.preventDefault()
    let me = $(this)
    let parent = me.closest('.cart-item-qty');
    let input = parent.find('input[type=number]')
    let value = input.val();
    const min = input.attr('min');
    const max = input.attr('max');
    value++;
    if(value <= min){
        value = min;
    }
    if(value >= max){
        value = max;
    }
    input.val(value);
})
$(document).on('click','.cart-item-qty .down',function (e) {
    e.preventDefault()
    let me = $(this)
    let parent = me.closest('.cart-item-qty');
    let input = parent.find('input[type=number]')
    let value = input.val();
    const min = input.attr('min');
    const max = input.attr('max');
    value--;
    if(value <= min){
        value = min;
    }
    if(value >= max){
        value = max;
    }
    input.val(value);
})
var BCApp ={
    showSuccess:function (configs){
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.success;
        }
        args.centerVertical = true;
        alert(args.message);
    },
    showError:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.warning;
        }
        args.centerVertical = true;
        alert(args.message);
    },
    showAjaxError:function (e) {
        var json = e.responseJSON;
        if(typeof json !='undefined'){
            if(typeof json.errors !='undefined'){
                var html = '';
                _.forEach(json.errors,function (val) {
                    html+=val+'<br>';
                });

                return this.showError(html);
            }
            if(json.message){
                return this.showError(json.message);
            }
        }
        if(e.responseText){
            return this.showError(e.responseText);
        }
    },
    showAjaxMessage:function (json) {
        if(json.message)
        {
            if(json.status){
                this.showSuccess(json);
            }else{
                this.showError(json);
            }
        }
    },
    showConfirm:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }
        args.buttons = {
            confirm: {
                label: '<i class="fa fa-check"></i> '+i18n.confirm,
            },
            cancel: {
                label: '<i class="fa fa-times"></i> '+i18n.cancel,
            }
        };
        args.centerVertical = true;
        bootbox.confirm(args);
    }
};

jQuery(function ($) {

    var onSubmitSubscribe = false;
    //Subscribe box
    $('.axtronic-subscribe-form').submit(function (e) {
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
                // console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if(ajax_error_to_string(e)){
                    me.find('.form-mess').html('<span class="text-danger">' + ajax_error_to_string(e) + '</span>');
                }else
                if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });

    $('.axtronic-product-quick-view').on('click',function (e) {
        e.preventDefault();
        let $this = $(this);
        let product = $(this).data('product');
        let quickView = $('.mf-quick-view-modal');
        $.ajax({
            url: BC.url + '/product/quick_view/' + product.id,
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

    $(".axtronic_form_filter input[type=checkbox],.axtronic_form_filter select[name=sort]").change(function () {
        $(this).closest(".axtronic_form_filter").submit();
    });

    var nonLinearSlider = document.getElementById('nonlinear');
    if (typeof nonLinearSlider != 'undefined' && nonLinearSlider != null) {

        var from = nonLinearSlider.getAttribute("data-from");
        var to = nonLinearSlider.getAttribute("data-to");
        var min = nonLinearSlider.getAttribute("data-min");
        var max = nonLinearSlider.getAttribute("data-max");
        noUiSlider.create(nonLinearSlider, {
            connect: true,
            behaviour: 'tap',
            start: [from, to],
            range: {
                min: parseInt(min),
                max: parseInt(max),
            },
        });

        nonLinearSlider.noUiSlider.on('update', function(values, handle) {
            $(".axtronic-slider-price .slider-min").html(  Math.round(values[0]) );
            $(".axtronic-slider-price .slider-max").html(  Math.round(values[1]) );
            $(".axtronic-slider-price input[name=min_price]").val(  Math.round(values[0]) );
            $(".axtronic-slider-price input[name=max_price]").val(  Math.round(values[1]) );
        });
    }

    $(document).on("click",".service-wishlist",function(){
        var $this = $(this);
        $.ajax({
            url:  BC.url+'/user/wishlist',
            data: {
                object_id: $this.attr("data-id"),
                object_model: $this.attr("data-type"),
            },
            dataType: 'json',
            type: 'POST',
            beforeSend: function() {
                $this.addClass("loading");
            },
            success: function (res) {
                if(res.status){
                    $this.toggleClass('active');
                }
                if(res.fragments){
                    for(var k in res.fragments){
                        $(k).html(res.fragments[k]);
                    }
                }
            },
            error:function (e) {
                if(e.status === 401){
                    $('.site-user-side').toggleClass('active');
                }
            }
        })
    });

});

//Review
$('.review-form .review-items .rates i').each(function () {
    var list = $(this).parent(),
        listItems = list.children(),
        itemIndex = $(this).index(),
        parentItem = list.parent();
    $(this).hover(function () {
        for (var i = 0; i < listItems.length; i++) {
            if (i <= itemIndex) {
                $(listItems[i]).addClass('primary-color');
            } else {
                break;
            }
        }
        $(this).on('click',function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('primary-color-hover');
                } else {
                    $(listItems[i]).removeClass('primary-color-hover');
                }
            }
            parentItem.children('.review_stats').val(itemIndex + 1);
        });
    }, function () {
        listItems.removeClass('primary-color');
    });
});

jQuery(function ($) {
    function parseErrorMessage(e) {
        var html = '';
        if (e.responseJSON) {
            if (e.responseJSON.errors) {
                return Object.values(e.responseJSON.errors).join('<br>');
            }
        }
        return html;
    }
    var onSubmitContact = false;
    $('.axtronic-contact-block').submit(function(e) {
        e.preventDefault();
        if (onSubmitContact)
            return;
        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');
        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
                onSubmitContact = false;
                me.removeClass('loading');
                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }
                if (json.status) {
                    me.find('input:not(input[type=submit])').val('');
                    me.find('textarea').val('');
                }
            },
            error: function(e) {
                // console.log(e);
                onSubmitContact = false;
                me.removeClass('loading');
                if (parseErrorMessage(e)) {
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                } else if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }
            }
        });
        return false;
    });

    var compare_box = $('.bravo_compare_box').modal();

    var compare_count = $('.bc-compare-count .number');

    $('.bc-compare-count').on('click',function () {
        compare_box.modal("show");
    });
    $(".bravo_compare_box .btn-close").click(function () {
        compare_box.modal("hide");
    });

    $(document).on('click','.axtronic-compare',function (e) {
        e.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-id');
        if ($this.hasClass('browse')){
            compare_box.modal("show");
        } else {
            $.ajax({
                url: BC.url + '/product/compare',
                method: 'POST',
                data: {id: id},
                beforeSend: function () {
                    $this.tooltip('hide').removeClass('browse').addClass('loading');
                },
                success:function (data) {
                    compare_count.html(data.count);
                    compare_box.find('.compare-list').html(data.view);
                    compare_box.modal("show")
                }
            })
        }
    })
    $(document).on('click','.axtronic-remove-compare',function (e) {
        e.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-id');
        $.ajax({
            url: BC.url + '/product/remove_compare',
            method:'POST',
            data: {id: id},
            beforeSend: function () {
                $this.addClass('loading');
            },
            success: function (data) {
                $this.removeClass('loading');
                compare_count.html(data.count);
                compare_box.find('.compare-list').html(data.view);
            }
        })
    })
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $(document).on('click','.axtronic-product-variations .item-disable',function (e) {
        $('.axtronic-product-variations input').prop('checked', false);
        $(this).find('input').prop('checked', true);
        $('.axtronic-product-variations .item-disable').removeClass("item-disable");
        $('.axtronic-product-variations input').trigger('change');
    });

    $('.axtronic-product-variations input').on('change', function() {

        $('.axtronic-product-variations .axtronic-checkbox').removeClass("item-active");
        var list_attribute_selected = [];
        $('.item-attribute:checked', '.axtronic-product-variations').each(function () {
            list_attribute_selected.push( parseInt( $(this).val() ));
            $(this).closest(".axtronic-checkbox").addClass("item-active");
        });

        // Find variation ID
        var list_variations = JSON.parse( $('.axtronic_variations').val() );
        var variation_id = '';
        var variation_selected = '';
        for (var id in list_variations){
            var variation = list_variations[id];
            var terms = [];
             for(var id2 in variation['terms']){
                var term = variation['terms'][id2];
                 terms.push( term.id );
            }
            let intersection = terms.filter(x => !list_attribute_selected.includes(x));
            if(intersection == ""){
                variation_id = variation["variation_id"];
                variation_selected = variation['variation'];
            }
        }
        $('.axtronic-product-variations input[name=variation_id]').attr("value",variation_id);
        // For show SKU PRICE IMAGE
        if(variation_selected !== ""){
            $('.axtronic-product-variations .price').removeClass("d-none").find(".value").html(variation_selected.price);
            $('.axtronic-product-variations .sku').removeClass("d-none").find(".value").html(variation_selected.sku);
            if(variation_selected.is_manage_stock){
                $('.axtronic-product-variations .quantity').removeClass("d-none").find(".value").html(variation_selected.quantity);
                $(".axtronic_form_add_to_cart input[name=quantity]").attr('max',variation_selected.quantity);
                if($(".axtronic_form_add_to_cart input[name=quantity]").val() > variation_selected.quantity && variation_selected.quantity != null){
                    $(".axtronic_form_add_to_cart input[name=quantity]").val(variation_selected.quantity);
                }
            }else{
                $('.axtronic-product-variations .quantity').addClass("d-none");
            }
            if(variation_selected.image){
                var old = $(".axtronic-product_thumbnail .item-0 img").attr("src");
                $(".axtronic-product_thumbnail .item-0 img").attr("data-old",old).attr('src',variation_selected.image).click();
            }
        }else{
            if($(".axtronic-product_thumbnail .item-0 img").attr("data-old")){
                $(".axtronic-product_thumbnail .item-0 img").attr('src',$(".bc-product_thumbnail .item-0 img").attr("data-old"));
            }
            $('.axtronic-product-variations .price,.axtronic-product-variations .sku,.axtronic-product-variations .quantity').addClass('d-none');
        }
        // Check show - hidden attribute
        var list_atttributes = [];
        for (var id in list_variations){
            var variation = list_variations[id];
            var cache = [];
            for(var id2 in variation['terms']) {
                var term = variation['terms'][id2];
                cache.push( term.id );
            }
            let intersection = cache.filter(x => list_attribute_selected.includes(x));
            if(intersection.length == list_attribute_selected.length){
                list_atttributes = list_atttributes.concat(cache);
            }
        }
        $('.axtronic-product-variations .item-attribute').each(function () {
            var check = false;
            for ( var id in list_atttributes ){
                if(  $(this).val() == list_atttributes[id] ){
                    check = true;
                }
            }
            if(!check){
                $(this).closest(".axtronic-checkbox").addClass("item-disable");
            }
        });
    });

    $(document).on('click','.btn-confirm-del',function (e) {
        var c = confirm(i18n.confirm_delete);
        if(!c){
            return false;
        }
    })




    /// Home page Slider Swiper
    const swiperBannerSlider = new Swiper('.banner-slider', {
        // Optional parameters
        loop: true,
        cssMode: true,
        effect: "fade",
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        // Navigation arrowsss
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    const swiperSliderIcon = new Swiper('.swiper-slider-icon', {
        // Optional parameters
        loop: true,
        cssMode: true,
        spaceBetween: 15,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 7
            },
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    const swiperSliderTestimonial = new Swiper('.swiper-slider-testimonial', {
        // Optional parameters
        loop: true,
        cssMode: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 3
            },
        },
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    const swiperSliderNews = new Swiper('.swiper-slider-news', {
        // Optional parameters
        loop: true,
        cssMode: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 3
            },
        },
        // If we need pagination
        pagination: {
            clickable: true,
            el: '.swiper-pagination',

        },
    });
    const swiperSliderBrands = new Swiper('.swiper-slider-brands', {
        // Optional parameters
        loop: true,
        cssMode: true,
        spaceBetween: 30,
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 6
            },
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });

    const swiperProductSlider = new Swiper('.product-slider', {
        // Optional parameters
        loop: false,
        cssMode: true,
        spaceBetween: 30,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 5
            },
        },
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    const swiperProductSliderBestSelling = new Swiper('.product-slider-bestselling', {
        // Optional parameters
        loop: true,
        cssMode: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4
            },
        },
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    const swiperProductGallery = new Swiper(".axtronic-product_variants", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    const swiperProductthumbs = new Swiper(".swiper-product-gallery", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiperProductGallery,
        },
    });

    const swiperProductRelated = new Swiper('.axtronic-swiper-relate', {
        // Optional parameters
        loop: false,
        cssMode: false,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 5
            },
        },
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    let param = getUrlParameter('layout');
    if (param === 'list'){
        $('.axtronic-products').addClass('product-lists');
        $('.axtronic-products').removeClass('products');
        $('.gridlist-toggle .list').addClass('active');
        $('.gridlist-toggle .grid').removeClass('active');
    }else {
        $('.gridlist-toggle .grid').addClass('active');
        $('.gridlist-toggle .list').removeClass('active');
    }

    // Onchange Select Category Product Search Header
    function getName(select) {
        // And here we get the name
        var selectedOption = select.options[select.selectedIndex];
        var name = selectedOption.getAttribute('data-name');
        document.getElementById("product-cat-name").innerHTML =  name;
    }




    // Show/Hide Canvas right
    $(document).on('click','.cart-contents',function (e) {
        e.preventDefault();
        $('.site-cart-side').toggleClass('active');;
    });
    $('.close-cart-side,.cart-side-overlay').on('click', function (e) {
        e.preventDefault();
        $('.site-cart-side').removeClass('active');
    });

    $(document).on('click','.user-contents',function (e) {
        e.preventDefault();
        $('.site-user-side').toggleClass('active');;
    })
    $('.close-user-side,.user-side-overlay').on('click', function (e) {
        e.preventDefault();
        $('.site-user-side').removeClass('active');
    });

    $(document).on('click','.wishlist-contents',function (e) {
        e.preventDefault();
        $('.site-wishlist-side').toggleClass('active');;
    })
    $('.close-wishlist-side,.wishlist-side-overlay').on('click', function (e) {
        e.preventDefault();
        $('.site-wishlist-side').removeClass('active');
    });

    $(document).on('click','.menu-mobile-nav-button',function (e) {
        e.preventDefault();
        $('.site-menu-side').toggleClass('active');;
    })
    $('.close-menu-side,.menu-side-overlay').on('click', function (e) {
        e.preventDefault();
        $('.site-menu-side').removeClass('active');
    });

    var $container = $('.side-account-form-wrap');
    $('.register-link', $container).on('click', function(e){
        e.preventDefault();
        $container.find('.form-register').addClass('active');
        $container.find('.form-login').removeClass('active')
        $container.find('.form-lost-password').removeClass('active');
    });
    $('.lostpass-link', $container).on('click', function(e){
        e.preventDefault();
        $container.find('.form-lost-password').addClass('active');
        $container.find('.form-login').removeClass('active')
        $container.find('.form-register').removeClass('active');
    });
    $('.login-link', $container).on('click', function(e){
        e.preventDefault();
        $container.find('.form-login').addClass('active')
        $container.find('.form-lost-password').removeClass('active');
        $container.find('.form-register').removeClass('active');
    });

    $('.mobile-nav-tabs li').on('click', function () {
        if ($(this).hasClass('active')) return;
        var menuName = $(this).data('menu');
        $(this).parent().find('.active').removeClass('active');
        $(this).addClass('active');
        $('.mobile-menu-tab').removeClass('active');
        $('.mobile-' + menuName + '-menu').addClass('active');
    });
});
