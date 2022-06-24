jQuery(function ($) {
    //Product detail
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
            console.log($(this).val());
            list_attribute_selected.push( parseInt( $(this).val() ));
            $(this).closest(".item").addClass("item-active");
        });

        // Find variation ID
        var list_variations = JSON.parse( $('.bc_variations').val() );
        var variation_id = '';
        var variation_selected = '';
        console.log(list_variations);
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
        console.log("Variation_id:" + variation_id);
        $('.bc-product-variations input[name=variation_id]').attr("value",variation_id);
        // For show SKU PRICE IMAGE
        if(variation_selected !== ""){
            $('.bc-product-variations .price').removeClass("d-none").find(".value").html(variation_selected.price);
            $('.bc-product-variations .sku').removeClass("d-none").find(".value").html(variation_selected.sku);
            if(variation_selected.is_manage_stock){
                $('.bc-product-variations .quantity').removeClass("d-none").find(".value").html(variation_selected.quantity);
                $(".bc_form_add_to_cart input[name=quantity]").attr('max',variation_selected.quantity);
                if($(".bc_form_add_to_cart input[name=quantity]").val() > variation_selected.quantity && variation_selected.quantity != null){
                    $(".bc_form_add_to_cart input[name=quantity]").val(variation_selected.quantity);
                }
                if(variation_selected.quantity < 1){
                    $(".btn-add-to-cart").addClass(['btn-secondary','disabled']);
                }else{
                    $(".btn-add-to-cart").removeClass(['btn-secondary','disabled']);
                }
            }else{
                $('.bc-product-variations .quantity').addClass("d-none");
                $(".bc_form_add_to_cart input[name=quantity]").removeAttr('max');
                $(".btn-add-to-cart").removeClass(['btn-secondary','disabled']);
            }
            if(variation_selected.image){
                var old = $(".bc-product_thumbnail .item-0 img").attr("src");
                $(".bc-product_thumbnail .item-0 img").attr("data-old",old).attr('src',variation_selected.image).click();
            }
        }else{
            if($(".bc-product_thumbnail .item-0 img").attr("data-old")){
                $(".bc-product_thumbnail .item-0 img").attr('src',$(".bc-product_thumbnail .item-0 img").attr("data-old"));
            }
            $('.bc-product-variations .price,.bc-product-variations .sku,.bc-product-variations .quantity').addClass('d-none');
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


    /*Evemt Single Page Counter JS Code*/
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

    $('.bc_count_down').each(function () {
        var end = $(this).data('end');
        var countDown = new Date(end).getTime();
        var me = $(this)
        setInterval(function() {
            let now = new Date().getTime(),
                distance = countDown - now;
            me.find('.bc-days').Math.floor(distance / (day));
            me.find('.bc-hours').Math.floor((distance % (day)) / (hour));
            me.find('.bc-minutes').Math.floor((distance % (hour)) / (hour));
            me.find('.bc-seconds').Math.floor((distance % (minute)) / (hour));

        }, 1000);
    })
});
