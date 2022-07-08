jQuery(function (){
    $(".be-carousel").each(function() {
        var elelemnt = $(this),
            dataAuto = elelemnt.data('owl-auto'),
            dataLoop = elelemnt.data('owl-loop'),
            dataSpeed = elelemnt.data('owl-speed'),
            dataGap = elelemnt.data('owl-gap'),
            dataNav = elelemnt.data('owl-nav'),
            dataDots = elelemnt.data('owl-dots'),
            dataAnimateIn = elelemnt.data('owl-animate-in') ? elelemnt.data('owl-animate-in') : '',
            dataAnimateOut = elelemnt.data('owl-animate-out') ? elelemnt.data('owl-animate-out') : '',
            dataDefaultItem = elelemnt.data('owl-item'),
            dataItemXS = elelemnt.data('owl-item-xs'),
            dataItemSM = elelemnt.data('owl-item-sm'),
            dataItemMD = elelemnt.data('owl-item-md'),
            dataItemLG = elelemnt.data('owl-item-lg'),
            dataItemXL = elelemnt.data('owl-item-xl'),
            dataNavLeft = elelemnt.data('owl-nav-left') ? elelemnt.data('owl-nav-left') : '<i class="fa fa-angle-left"></i>',
            dataNavRight = elelemnt.data('owl-nav-right') ? elelemnt.data('owl-nav-right') : '<i class="fa fa-angle-right"></i>',
            duration = elelemnt.data('owl-duration'),
            datamouseDrag = elelemnt.data('owl-mousedrag') == 'on' ? true : false;

        elelemnt.addClass('owl-carousel').owlCarousel({
            animateIn: dataAnimateIn,
            animateOut: dataAnimateOut,
            margin: dataGap,
            autoplay: dataAuto,
            autoplayTimeout: dataSpeed,
            autoplayHoverPause: true,
            loop: dataLoop,
            nav: dataNav,
            mouseDrag: datamouseDrag,
            touchDrag: true,
            autoplaySpeed: duration,
            navSpeed: duration,
            dotsSpeed: duration,
            dragEndSpeed: duration,
            navText: [dataNavLeft, dataNavRight],
            dots: dataDots,
            items: dataDefaultItem,
            rtl: false,
            responsive: {
                0: {
                    items: dataItemXS,
                },
                480: {
                    items: dataItemSM,
                },
                768: {
                    items: dataItemMD,
                },
                992: {
                    items: dataItemLG,
                },
                1200: {
                    items: dataItemXL,
                },
                1680: {
                    items: dataDefaultItem,
                },
            },
        });
    });
})
