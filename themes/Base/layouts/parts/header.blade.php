@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<header class="header">
    @include('layouts.parts.header.topbar')
    <div class="header__content py-3  border-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 header__content-left">
                    <a class="bc-logo" href="{{url('/')}}">
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
                <div class="col-md-2 header__content-right text-end">
                    <div class="dropdown dropstart">
                        <a  class="position-relative" data-bs-toggle="dropdown">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{\Modules\Order\Helpers\CartManager::count()}}
                            <span class="visually-hidden">{{__("Your cart")}}</span>
                          </span>
                        </a>
                        <div class="dropdown-menu">
                            @includeIf('order.cart.mini-cart')
                        </div>
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
