<div class="ps-newsletter d-none">
    <div class="container">
        <div class="ps-form--newsletter">
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-form__left">
                        <h3>{{ __("Newsletter") }}</h3>
                        <p>{{ __("Subcribe to get information about products and coupons") }}</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-form__right">
                        <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bravo-subscribe-form bravo-form">
                            @csrf
                            <div class="form-group--nest">
                                <input class="form-control" type="email" placeholder="Email address">
                                <button class="ps-btn">{{ __("Subscribe") }}</button>
                            </div>
                            <div class="form-mess mt-2"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="ps-footer d-none">
    <div class="container">
        <div class="ps-footer__widgets">
            @if($footer_info_text = setting_item_with_lang("footer_info_text"))
                <aside class="widget widget_footer widget_contact-us">
                    <h4 class="widget-title">{{ __("Contact us") }}</h4>
                    <div class="widget_content">
                        {!! clean($footer_info_text) !!}
                    </div>
                </aside>
            @endif
            @if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                @foreach($list_widget_footers as $key=>$item)
                    <aside class="widget widget_footer ">
                        <h4 class="widget-title">{{$item->title}}</h4>
                        <div class="widget_content">
                            {!! clean($item->content) !!}
                        </div>
                    </aside>
                @endforeach
            @endif
        </div>
        <div class="ps-footer__links">
            @if($footer_categories = setting_item_with_lang("footer_categories"))
                {!! clean($footer_categories) !!}
            @endif
        </div>
        <div class="ps-footer__copyright">
            <div>{!! setting_item_with_lang("copyright") !!}</div>
            <div>{!! setting_item_with_lang("footer_socials") !!}</div>
        </div>

    </div>
</footer>
<div id="back2top"><i class="icon icon-arrow-up"></i></div>

@include('auth/login-register-modal')

<div class="container">
    <footer class="py-5">
        <div class="row">
            <div class="col-2">
                <h5 class="font-21">Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
            </div>

            <div class="col-2">
                <h5 class="class="font-21"">Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
            </div>

            <div class="col-2">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
            </div>

            <div class="col-4 offset-1">
                <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of whats new and exciting from us.</p>
                    <div class="d-flex w-100 gap-2">
                        <input id="newsletter1" type="text" class="form-control mr-2" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between py-4 my-4 border-top">
            <p>&copy; 2021 Company, Inc. All rights reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
            </ul>
        </div>
    </footer>
</div>

