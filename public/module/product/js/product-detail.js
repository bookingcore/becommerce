$(document).ready(function () {
    console.log($('.product-related').length);
    if($('.product-related').length>0){
        $('.product-related').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 255,
            rtl: true
        });
    }
    if($('.product-detail-gallery').length>0){
        $('.product-detail-gallery').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    }
    
    $('.add_to_cart').click(function (e) {
        e.preventDefault();
        var p = $(this).closest('.product-detail-add-to-cart');
        $.ajax({
            url:bookingCore.url+'/cart/add',
            type:"post",
            data:{
                quantity:p.find('[name=quantity]').val(),
				product_id:p.find('[name=product_id]').val(),
            },
            success:function () {

			}
        })
	})

})