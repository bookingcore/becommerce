<div class="bravo_topbar bg-dark py-1">
    <div class="container">
        <div class="d-flex justify-content-lg-between justify-content-end align-items-center">
            <div class="topbar-left text-white align-items-center d-none d-lg-flex">
                {!! clean(setting_item_with_lang("topbar_left_text")) !!}
            </div>
            <div class="topbar-right">
                <ul class="topbar-items nav">
                    @include('layouts.parts.header.currency-switcher')
                    @include('layouts.parts.header.language-switcher')
                    @if(is_vendor_enable() and !is_vendor())
                        <li class="login-item">
                            <a href="{{route('vendor.register')}}" class="login nav-link text-white">{{__('Sell on Us!')}}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
