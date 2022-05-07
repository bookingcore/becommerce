<div class="axtronic_topbar">
    <div class="container">
        <div class="topbar-box d-flex justify-content-lg-between justify-content-end align-items-center">
            <div class="topbar-left align-items-center d-none d-md-flex">
                @php generate_menu('department',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
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
                    @if(Auth::id())
                    @include('layouts.parts.header.user')
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
