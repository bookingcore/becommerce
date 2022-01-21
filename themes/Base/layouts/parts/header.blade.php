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
                    <div class="bc-compare-count me-4">
                        <a  class="position-relative c-main-hover">
                            <i class="fa fa-bar-chart fa-2x c-main"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
                                {{ count(session('compare')) }}
                            </span>
                        </a>
                    </div>
                    <div class="bc-header-wishlist me-4">
                        @if(Auth::user())
                            <a  class="position-relative" href="{{route('user.wishList.index')}}">
                                <i class="fa fa-heart fa-2x c-main"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ countWishlist() }}
                                    <span class="visually-hidden">{{__("WishList")}}</span>
                                </span>
                            </a>
                        @else
                            <a  class="position-relative" href="#login" data-toggle="modal" class="counter-wrap" data-target="#login">
                                <i class="fa fa-heart fa-2x c-main"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    0
                                    <span class="visually-hidden">{{__("WishList")}}</span>
                                </span>
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
            <nav class="navbar navbar-expand-lg pt-0 pb-0">
                <div class="collapse navbar-collapse" id="bc-main-menu">
                    @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </div>
            </nav>
        </div>
    </nav>
</header>
