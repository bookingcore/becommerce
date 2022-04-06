<!-- header top -->
<div class="header_top bgc-thm2 dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="ht_contact_widget">
                    <ul class="m0">
                        <li class="list-inline-item"><a href="#"><span class="flaticon-phone-call mr5"></span> (+035) 527-1710-70</a></li>
                        <li class="list-inline-item"><a href="#"><span class="flaticon-email mr5"></span> order@freshen.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="ht_contact_widget text-center">
                    @if(is_vendor_enable() and !is_vendor())
                        <li class="login-item">
                            <a href="{{route('vendor.register')}}" class="login nav-link text-white">{{__('Sell on Us!')}}</a>
                        </li>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="ht_language_widget text-end">
                    <ul class="m0">
                        @include('layouts.parts.header.language-switcher')
                        @include('layouts.parts.header.currency-switcher')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
