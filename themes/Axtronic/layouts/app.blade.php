<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
        <link href="{{ theme_url('Axtronic/style.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        <script>
            var BC = {
                url: '{{url( app_get_locale() )}}',
            }
            var i18n = {
                warning:"{{__("Warning")}}",
                success:"{{__("Success")}}",
                please_fill_out:'{{__("Please fill out this field.")}}',
                delete_cart_item_confirm:'{{__("Do you want to delete this cart item?")}}',
            };
        </script>
        @yield('head')
    </head>
    <body class="{{$body_class ?? ''}}">
        @include('layouts.parts.header')
        <main class="flex-shrink-0">
            @yield('content')
        </main>
        <footer class="footer">
            @include('layouts.parts.footer')
            @include('product.compare.compare-modal')

            <script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
            <script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
            <script async src="{{asset('libs/bootbox/bootbox.all.min.js')}}"></script>
            <script>

                window.lazyLoadOptions = {
                    elements_selector: ".lazy",
                };

                window.addEventListener('LazyLoad::Initialized', function (event) {
                    window.lazyLoadInstance = event.detail.instance;
                }, false);


            </script>

            <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
            <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/owl-carousel/owl.carousel.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/vue/vue.js"></script>
            <script src="{{ theme_url('Base') }}/libs/nouislider/nouislider.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/slick/slick.min.js"></script>
            <!-- custom scripts-->
            <script  src="{{ theme_url('Base/js/app.js') }}"></script>

            <script>
                const swiperBannerSlider = new Swiper('.banner-slider', {
                    // Optional parameters
                    loop: true,
                    effect: "fade",
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination',
                    },

                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
                const swiperSliderIcon = new Swiper('.swiper-slider-icon', {
                    // Optional parameters
                    loop: true,
                    cssMode: true,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                        1024: {
                            slidesPerView: 7
                        },
                    },
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
                const swiperSliderTestimonial = new Swiper('.swiper-slider-testimonial', {
                    // Optional parameters
                    loop: true,
                    cssMode: true,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 1,
                        },
                        1024: {
                            slidesPerView: 3
                        },
                    },
                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination',
                    },
                });
                const swiperSliderNews = new Swiper('.swiper-slider-news', {
                    // Optional parameters
                    loop: true,
                    cssMode: true,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 1,
                        },
                        1024: {
                            slidesPerView: 3
                        },
                    },
                    // If we need pagination
                    pagination: {
                        clickable: true,
                        el: '.swiper-pagination',
                    },
                });
                const swiperSliderBrands = new Swiper('.swiper-slider-brands', {
                    // Optional parameters
                    loop: true,
                    cssMode: true,
                    spaceBetween: 30,
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        1024: {
                            slidesPerView: 6
                        },
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                });
            </script>
            @yield('footer')
        </footer>
    </body>
</html>
