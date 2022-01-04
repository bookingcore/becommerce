jQuery(function () {
    $(document).on('click','.cart-item-qty .up',function (e) {
        e.preventDefault()
        let me = $(this)
        let parent = me.closest('.cart-item-qty');
        let input = parent.find('input[type=number]')
        let value = input.val();
        const min = input.data('min');
        const max = input.data('max');
        value = value++;
        if(value <= min){
            value = min;
        }
        if(value => max){
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
        const min = input.data('min',1);
        const max = input.data('max',1);
        value = --value;
        if(value <= min){
            value = min;
        }
        if(value => max){
            value = max;
        }
        input.val(value);
    })

    $(".bc_apply_coupon").click(function () {
        var parent = $(this).closest('.section-coupon-form');
        parent.find(".group-form .fa-spin").removeClass("d-none");
        parent.find(".message").html('');
        $.ajax({
            'url': '/cart/apply_coupon',
            'data': parent.find('input,textarea,select').serialize(),
            'cache': false,
            'method':"post",
            success: function (res) {
                parent.find(".group-form .fa-spin").addClass("d-none");
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
            'url': 'cart/remove-coupon',
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
})
