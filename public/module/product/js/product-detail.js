$(document).ready(function () {
    // console.log($('.product-related').length);
    /*if($('.product-related').length>0){
        $('.product-related').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 255,
            rtl: true
        });
    }*/
    if($('.product-detail-gallery').length>0){
        $('.product-detail-gallery').flexslider({
            animation: "slide",
            controlNav: "thumbnails",
        });
    }

    $('.tawcvs-swatches .swatch').click(function (e) {
        let $this = $(this);
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
                    if (parseInt(i.vProduct_attr.is_manage_stock) > 0){
                        if (i.vProduct_attr.stock_status === 'in'){
                            $stock = i18n.num_stock.replace('__num__',i.vProduct_attr.quantity);
                        }
                    } else {
                        $stock = i18n.in_stock;
                    }
                    if (i.vProduct_attr.stock_status === 'out'){
                        $stock = i18n.out_stock;
                        $in_stock = false;
                    }

                    if (!isNaN(parseInt(i.vProduct_attr.price)) && parseInt(i.vProduct_attr.price) > 0){
                        $('.single_variation_wrap').addClass('active');
                        $('.single_variation_wrap .variation-price').attr('data-price',i.vProduct_attr.price).html(window.bravo_format_money(i.vProduct_attr.price));
                        $('.single_variation_wrap .variation-stock').removeClass('out-of-stock in_stock').addClass( $in_stock ? 'in_stock' : 'out-of-stock' ).find('.stock-status').html($stock);
                        if ($('.single_variation_wrap .variation-stock').hasClass('out-of-stock')){
                            $('.bravo_add_to_cart').attr('disabled','disabled');
                        } else {
                            $('.bravo_add_to_cart').removeAttr('disabled');
                        }
                    }
                } else {
                    return false;
                }
            })
            if (variable_error === true){
                $('.single_variation_wrap').removeClass('active');
                $('.bravo_add_to_cart').attr('disabled','disabled');
            }
        }
    })
})

