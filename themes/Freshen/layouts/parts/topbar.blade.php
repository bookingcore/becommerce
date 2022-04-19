<!-- header top -->
<div class="header_top bgc-thm2 dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="ht_contact_widget">
                    <ul class="m0">
                        <li class="list-inline-item"><a href="tel:{{ setting_item('freshen_hotline_contact') }}"><span class="flaticon-phone-call mr5"></span> {{ setting_item('freshen_hotline_contact') }}</a></li>
                        <li class="list-inline-item"><a href="mailto:{{setting_item('freshen_email_contact')}}"><span class="flaticon-email mr5"></span> {{ setting_item('freshen_email_contact') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="ht_contact_widget text-center">
                    
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
