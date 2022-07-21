jQuery(function () {
    if($('.be-counter').length){
        $('.be-counter').appear(function(){
            var $t = $(this),
                n = $t.find(".counter-number").attr("data-stop"),
                r = parseInt($t.find(".counter-number").attr("data-speed"), 10);

            if (!$t.hasClass("counted")) {
                $t.addClass("counted");
                $({
                    countNum: $t.find(".counter-number").text()
                }).animate({
                    countNum: n
                }, {
                    duration: r,
                    easing: "linear",
                    step: function() {
                        $t.find(".counter-number").text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $t.find(".counter-number").text(this.countNum);
                    }
                });
            }

        },{accY: 0});
    }
})
