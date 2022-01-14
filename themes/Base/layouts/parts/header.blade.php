@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<header class="header">
    @include('layouts.parts.header.topbar')
    <div class="header__content py-3  border-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 header__content-left">
                    <a class="bc-logo text-decoration-none" href="{{url('/')}}">
                        @if($logo_id = setting_item("logo_id"))
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        @else
                            <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
                        @endif
                    </a>
                </div>
                <div class="col-md-7 header__content-center">
                    <div class="px-5">
                        @include('layouts.parts.header.search')
                    </div>
                </div>
                <div class="col-md-2 text-end d-flex justify-content-end">
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
    <nav class="navigation py-1 border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="navigation__left">
                    @php generate_menu('primary') @endphp
                </div>
            </div>
        </div>
    </nav>
</header>
