jQuery(function () {
    $(".be-dropdown").each(function () {
        $(this).on('click', '.be-dropdown-toggle', function () {
            var container = $(this).closest('.be-dropdown');
            if(container.find('.be-dropdown-menu').hasClass('hidden')){
                container.find('.be-dropdown-menu').removeClass('hidden').show();
                container.addClass('z-50');
            }else{
                container.find('.be-dropdown-menu').addClass('hidden').hide();
                container.removeClass('z-50');
            }
            $(document).on('click', function (e) {
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.find('.be-dropdown-menu').addClass('hidden');
                    container.removeClass('z-50');
                }
            });
        })
    })
})
