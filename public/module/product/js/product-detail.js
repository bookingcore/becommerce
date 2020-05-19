$(document).ready(function () {
    console.log($('.product-related').length);
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


})

