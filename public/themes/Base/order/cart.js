jQuery(function () {
    $(".bc_apply_coupon").click(function () {
        var parent = $(this).closest('.section-coupon-form');
        parent.find("button .fa-spin").removeClass("d-none");
        parent.find(".message").html('');
        $.ajax({
            'url': BC.url+'/cart/apply_coupon',
            'data': parent.find('input,textarea,select').serialize(),
            'cache': false,
            'method':"post",
            success: function (res) {
                parent.find("button .fa-spin").addClass("d-none");
                if (res.reload !== undefined) {
                    window.location.reload();
                }
                if(res.message && res.status === 1)
                {
                    parent.find('.message').html('<div class="alert alert-success">' + res.message+ '</div>');
                }
                if(res.message && res.status === 0)
                {
                    parent.find('.message').html('<div class="alert alert-danger">' + res.message+ '</div>');
                }
            }
        });
    });
    $(".bc_remove_coupon").click(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.section-coupon-form');
        var parentItem = $(this).closest('.item');
        parentItem.find(".fa-spin").removeClass("d-none");
        $.ajax({
            'url': BC.url+'/cart/remove_coupon',
            'data': {
                coupon_code:$(this).attr('data-code')
            },
            'cache': false,
            'method':"post",
            success: function (res) {
                parentItem.find(".fa-spin").addClass("d-none");
                if (res.reload !== undefined) {
                    window.location.reload();
                }
                if(res.message && res.status === 0)
                {
                    parent.find('.message').html('<div class="alert alert-danger">' + res.message+ '</div>');
                }
            }
        });
    });

    $(".bc_calculate_shipping").click(function () {
        var parent = $(this).closest('.section-shipping-form');
        parent.find(".fa-spin").removeClass("d-none");
        parent.find(".message").html('');
        $.ajax({
            'url': BC.url+'/cart/calculate_shipping',
            'data': parent.find('input,textarea,select').serialize(),
            'cache': false,
            'method':"post",
            success: function (res) {
                parent.find(".fa-spin").addClass("d-none");
                if (res.reload !== undefined) {
                    window.location.reload();
                }
                if(res.message && res.status === 1)
                {
                    parent.find('.message').html('<div class="alert alert-success">' + res.message+ '</div>');
                }
                if(res.message && res.status === 0)
                {
                    parent.find('.message').html('<div class="alert alert-danger">' + res.message+ '</div>');
                }
            }
        });
    });
    $(".section-shipping-form input[type=radio]").change(function () {
        var parent = $(this).closest('.section-shipping-form');
        parent.find('.bc_calculate_shipping').click();
    })
})
