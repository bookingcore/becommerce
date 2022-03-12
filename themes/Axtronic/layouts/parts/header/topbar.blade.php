<div class="axtronic_topbar">
    <div class="container">
        <div class="topbar-box d-flex justify-content-lg-between justify-content-end align-items-center">
            <div class="topbar-left align-items-center d-none d-md-flex">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Support
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Featured Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            FAQ
                        </a>
                    </li>
                </ul>
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
