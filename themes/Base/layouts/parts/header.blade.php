@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<header class="header">
    @include('layouts.parts.header.topbar')
    <div class="header_content py-3  border-bottom">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col-6 order-0 order-lg-0 header__content-left">
                    <a class="bc-logo text-decoration-none" href="{{url('/')}}">
                        @if($logo_id = setting_item("logo_id"))
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        @else
                            <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
                        @endif
                    </a>
                </div>
                <div class="col-lg-7 col-12 order-2 order-lg-1 mt-2 mt-lg-0 header__content-center">
                    @include('layouts.parts.header.search')
                </div>
                <div class="col-lg-2 col-6 order-1 order-lg-2 text-end d-flex justify-content-end">
                    <div class="bc-header-wishlist">
                        @if(Auth::user())
                            <a class="counter-wrap" href="{{route('user.wishList.index')}}">
                                <i class="fa fa-heart fs-32 c-main"></i>
                                <span class="counter bg-danger text-center c-white">{{ countWishlist() }}</span>
                            </a>
                        @else
                            <a href="#login" data-toggle="modal" class="counter-wrap" data-target="#login">
                                <i class="fa fa-heart fs-32"></i>
                                <span class="counter">0</span>
                            </a>
                        @endif
                    </div>
                    <div class="bc-mini-cart">
                        @includeIf('order.cart.mini-cart')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation py-1 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="navigation_left">
                    @php generate_menu('primary') @endphp
                </div>
            </div>
        </div>
    </nav>
    <div class="bc-mobile-nav d-lg-none">
        <div class="bc-mobile-overlay position-fixed"></div>
        <div class="bc-mobile-content w-100 position-fixed overflow-auto h-100 bg-white">
            <div class="bc-mobile-header p-3">
                <h2 class="fs-16 color-dark mb-0">{{ __('Main Menu') }}</h2>
                <a class="close-bc-mobile c-f30"><i class="fa fa-times"></i></a>
            </div>
            @php generate_menu('primary',['class' => 'bc-mobile-menu d-block my-2']) @endphp
        </div>
    </div>
</header>
