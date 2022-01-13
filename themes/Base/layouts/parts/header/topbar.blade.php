<div class="bravo_topbar bg-dark py-1">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="topbar-left text-white d-flex align-items-center">
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
                    @if(!Auth::id())
                        <li class="login-item">
                            <a href="#login" data-bs-toggle="modal" data-target="#login" class="login nav-link text-white">{{__('Login')}}</a>
                        </li>
                        <li class="signup-item">
                            <a href="#register" data-bs-toggle="modal" data-target="#register" class="signup  nav-link  text-white">{{__('Sign Up')}}</a>
                        </li>
                    @else
                        @include('layouts.parts.header.notification')
                        @include('layouts.parts.header.user')
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
