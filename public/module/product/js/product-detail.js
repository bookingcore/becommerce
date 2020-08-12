$(window).on('load',function () {
    let width = $(window).width();
    let gallery_box = $('.product-detail-gallery');
    if(gallery_box.length > 0){
        let slider = (width < 768) ? {animation:"slide"} : {animation:"slide", controlNav: "thumbnails"};
        gallery_box.flexslider(slider);
    }
})

