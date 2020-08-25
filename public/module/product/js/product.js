jQuery(function ($) {
    'use strict';
    $(".bravo-filter-price").each(function () {
        var input_price = $(this).find(".price_slider");
        var input_min = $(this).find('#min_price');
        var input_max = $(this).find('#max_price');
        var label_amount = $(this).find('.price_label');
        var min = input_min.data("min");
        var max = input_max.data("max");
        input_price.slider({
            range: true,
            min: min,
            max: max,
            values: [ input_price.data('from'), input_price.data('to') ],
            slide: function( event, ui ) {
                label_amount.find('.from').html(ui.values[0]);
                label_amount.find('.to').html(ui.values[1]);
                input_min.val(ui.values[0]);
                input_max.val(ui.values[1]);
            }
        });
        $( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
    });

    $(".bravo-block-list-item-carousel").each(function () {
            currentSlick = $(this).find('.list-item').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite:false,
                prevArrow: $(this).find('.slick-prev-arrow'),
                nextArrow: $(this).find('.slick-next-arrow'),
                });

    });

    $(".bravo_form_filter input[type=checkbox]").change(function () {
        $(this).closest(".bravo_form_filter").submit();
    });
});
