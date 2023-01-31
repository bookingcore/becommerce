(function($){
    $('.be-tabs .nav-item a').click(function (e) {
        e.preventDefault();

        var parent = $(this).closest('.be-tabs');
        var id = $(this).attr('href');
        if(parent.find(id).length){
            parent.find(id).show().siblings().hide();
            $(this).removeClass('hidden').addClass('block bg-white');
            $(this).parent().siblings().find('a').removeClass('bg-white');
        }
    })
})(jQuery);
