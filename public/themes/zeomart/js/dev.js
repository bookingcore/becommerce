jQuery(function (){
    $(".zm-dropdown").each(function (){
        var $this = $(this);
        $this.on('click','.zm-dropdown-toggle',function (){
            $this.find('.zm-dropdown-menu').toggleClass('hidden');
        })
        window.onclick = function(e) {
            console.log(e.target.matches('.zm-dropdown a'));
            console.log(e.target);
            if (!e.target.matches('.zm-dropdown')) {
                //$this.find('.zm-dropdown-menu').removeClass('active');
            }
        }
    })
})
