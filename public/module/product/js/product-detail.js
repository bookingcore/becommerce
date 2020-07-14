$(document).ready(function () {
    let width = $(window).width();
    let gallery_box = $('.product-detail-gallery');
    if(gallery_box.length > 0){
        if (width < 768) {
            gallery_box.flexslider({
                animation: "slide",
            });
        } else {
            gallery_box.flexslider({
                animation: "slide",
                controlNav: "thumbnails",
            });
        }
    }
})

