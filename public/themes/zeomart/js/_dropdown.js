jQuery(function () {
    $(".be-dropdown").each(function () {
        var $this = $(this);
        $this.on('click', '.be-dropdown-toggle', function () {
            var container = $(this).closest('.be-dropdown');
            container.find('.be-dropdown-menu').toggleClass('hidden');
            container.toggleClass('z-50');
            $(document).on('click', function (e) {
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.find('.be-dropdown-menu').addClass('hidden');
                }
            });
        })
    })
})
