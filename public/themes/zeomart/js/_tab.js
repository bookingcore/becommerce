(function($){
    $('.be-tabs .nav-item a').click(function () {
        var parent = $(this).closest('.zm-tabs');
        var id = $(this).attr('href');
        if(parent.find(id).length){
            parent.find(id).show().siblings().hide();
        }
    })
})(jQuery);
