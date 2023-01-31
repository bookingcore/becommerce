jQuery(function () {
    $(".faq-item .faq-header").on("click", function (e) {
        e.preventDefault();
        var p = $(this).parent();
        $(".faq-item").not(p).removeClass("active").find('.faq-content').slideUp();
        if (p.hasClass('active')){
            p.find('.faq-content').slideUp();
            p.removeClass('active');
        }else{
            p.find('.faq-content').slideDown();
            p.addClass('active');
        }
    });
});
