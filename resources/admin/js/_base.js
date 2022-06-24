(function ($) {
    $('.main-menu .btn-toggle').click(function () {
        var p = $(this).closest('li');
        if(p.hasClass('active')){
            p.removeClass('active');
        }else{
            p.siblings().removeClass('active');
            p.addClass('active');
        }
    });

    $('.btn-toggle-admin-menu,.backdrop-sidebar-mobile').click(function () {
       $('body').toggleClass('sidebar-toggled');
    });


})(jQuery);
