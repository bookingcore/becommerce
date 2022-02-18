$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content'),
        'Accept':'application/json'
    }
});
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
$('.bravo-form-login').on('submit',function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize()
    $.ajax({
        'url': '/login',
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
            if (typeof data.redirect !== 'undefined' && data.redirect) {
                window.location.href = data.redirect
            }
        },
        error:function (e){
            form.removeClass('loading')
            var html = ajax_error_to_string(e);
            if(html){
                form.find('.message-error').show().html('<div class="alert alert-danger"><p>' + html + '</p></div>');
            }
        }
    });
    return false;
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

$('.bc_form_add_to_cart').on('submit',function(e){
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
$(document).on('click','.bc_delete_cart_item',function(e){
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
    $('.bc-subscribe-form').submit(function (e) {
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

    $('.bc-product-quick-view').on('click',function (e) {
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

    $(".bc_form_filter input[type=checkbox],.bc_form_filter select[name=sort]").change(function () {
        $(this).closest(".bc_form_filter").submit();
    });

    $(".bc-carousel").each(function() {
        var elelemnt = $(this),
            dataAuto = elelemnt.data('owl-auto'),
            dataLoop = elelemnt.data('owl-loop'),
            dataSpeed = elelemnt.data('owl-speed'),
            dataGap = elelemnt.data('owl-gap'),
            dataNav = elelemnt.data('owl-nav'),
            dataDots = elelemnt.data('owl-dots'),
            dataAnimateIn = elelemnt.data('owl-animate-in') ? elelemnt.data('owl-animate-in') : '',
            dataAnimateOut = elelemnt.data('owl-animate-out') ? elelemnt.data('owl-animate-out') : '',
            dataDefaultItem = elelemnt.data('owl-item'),
            dataItemXS = elelemnt.data('owl-item-xs'),
            dataItemSM = elelemnt.data('owl-item-sm'),
            dataItemMD = elelemnt.data('owl-item-md'),
            dataItemLG = elelemnt.data('owl-item-lg'),
            dataItemXL = elelemnt.data('owl-item-xl'),
            dataNavLeft = elelemnt.data('owl-nav-left') ? elelemnt.data('owl-nav-left') : '<i class="fa fa-angle-left"></i>',
            dataNavRight = elelemnt.data('owl-nav-right') ? elelemnt.data('owl-nav-right') : '<i class="fa fa-angle-right"></i>',
            duration = elelemnt.data('owl-duration'),
            datamouseDrag = elelemnt.data('owl-mousedrag') == 'on' ? true : false;

        elelemnt.addClass('owl-carousel').owlCarousel({
            animateIn: dataAnimateIn,
            animateOut: dataAnimateOut,
            margin: dataGap,
            autoplay: dataAuto,
            autoplayTimeout: dataSpeed,
            autoplayHoverPause: true,
            loop: dataLoop,
            nav: dataNav,
            mouseDrag: datamouseDrag,
            touchDrag: true,
            autoplaySpeed: duration,
            navSpeed: duration,
            dotsSpeed: duration,
            dragEndSpeed: duration,
            navText: [dataNavLeft, dataNavRight],
            dots: dataDots,
            items: dataDefaultItem,
            rtl: false,
            responsive: {
                0: {
                    items: dataItemXS,
                },
                480: {
                    items: dataItemSM,
                },
                768: {
                    items: dataItemMD,
                },
                992: {
                    items: dataItemLG,
                },
                1200: {
                    items: dataItemXL,
                },
                1680: {
                    items: dataDefaultItem,
                },
            },
        });
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
            $(".bc-slider-price .slider-min").html(  Math.round(values[0]) );
            $(".bc-slider-price .slider-max").html(  Math.round(values[1]) );
            $(".bc-slider-price input[name=min_price]").val(  Math.round(values[0]) );
            $(".bc-slider-price input[name=max_price]").val(  Math.round(values[1]) );
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
            },
            error:function (e) {
                if(e.status === 401){
                    $('#login').modal('show');
                }
            }
        })
    });

});

$('.bc-product-detail').each(function () {
    var product = $(this);
    var primary = product.find('.bc-product_gallery'),
        second = product.find('.bc-product_variants'),
        vertical = product
            .find('.bc-product_thumbnail')
            .data('vertical');
    primary.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.bc-product_variants',
        fade: true,
        dots: false,
        infinite: false,
        arrows: primary.data('arrow'),
        prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
        nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
    });
    second.slick({
        slidesToShow: second.data('item'),
        slidesToScroll: 1,
        infinite: false,
        arrows: second.data('arrow'),
        focusOnSelect: true,
        prevArrow: "<a href='#'><i class='fa fa-angle-up'></i></a>",
        nextArrow: "<a href='#'><i class='fa fa-angle-down'></i></a>",
        asNavFor: '.bc-product_gallery',
        vertical: vertical,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: second.data('arrow'),
                    slidesToShow: 4,
                    vertical: false,
                    prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                    nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                },
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: second.data('arrow'),
                    slidesToShow: 4,
                    vertical: false,
                    prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                    nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    vertical: false,
                    prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                    nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                },
            },
        ],
    });
})

//Review
$('.review-form .review-items .rates .fa').each(function () {
    var list = $(this).parent(),
        listItems = list.children(),
        itemIndex = $(this).index(),
        parentItem = list.parent();
    $(this).hover(function () {
        for (var i = 0; i < listItems.length; i++) {
            if (i <= itemIndex) {
                $(listItems[i]).addClass('c-main');
            } else {
                break;
            }
        }
        $(this).on('click',function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('c-fcb800');
                } else {
                    $(listItems[i]).removeClass('c-fcb800');
                }
            }
            parentItem.children('.review_stats').val(itemIndex + 1);
        });
    }, function () {
        listItems.removeClass('c-main');
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
    $('.bc-contact-block').submit(function(e) {
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
                console.log(e);
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

    $(document).on('click','.bc-compare',function (e) {
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
    $(document).on('click','.bc-remove-compare',function (e) {
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

    $(document).on('click','.bc-product-variations .item-disable',function (e) {
        $('.bc-product-variations input').prop('checked', false);
        $(this).find('input').prop('checked', true);
        $('.bc-product-variations .item-disable').removeClass("item-disable");
        $('.bc-product-variations input').trigger('change');
    });

    $('.bc-product-variations input').on('change', function() {

        $('.bc-product-variations .item').removeClass("item-active");
        var list_attribute_selected = [];
        $('.item-attribute:checked', '.bc-product-variations').each(function () {
            list_attribute_selected.push( parseInt( $(this).val() ));
            $(this).closest(".item").addClass("item-active");
        });

        // Find variation ID
        var list_variations = JSON.parse( $('.bc_variations').val() );
        var variation_id = '';
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
            }
        }
        console.log("Variation_id:" + variation_id);
        $('.bc-product-variations input[name=variation_id]').attr("value",variation_id);

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
        $('.bc-product-variations .item-attribute').each(function () {
            var check = false;
            for ( var id in list_atttributes ){
                if(  $(this).val() == list_atttributes[id] ){
                    check = true;
                }
            }
            if(!check){
                $(this).closest(".item").addClass("item-disable");
            }
        });
    });

});
