<div class="bravo_footer site-footer footer-style-1">
    <div class="container">
        <div class="ps-block--site-features">
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-rocket"></i></div>
                <div class="ps-block__right">
                    <h4>{{ __('Free Delivery') }}</h4>
                    <p>{{ __('For all oders over $99') }}</p>
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-sync"></i></div>
                <div class="ps-block__right">
                    <h4>{{ __('90 Days Return') }}</h4>
                    <p>{{ __('If goods have problems') }}</p>
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                <div class="ps-block__right">
                    <h4>{{ __('Secure Payment') }}</h4>
                    <p>{{ __('100% secure payment') }}</p>
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                <div class="ps-block__right">
                    <h4>{{ __('24/7 Support') }}</h4>
                    <p>{{ __('Dedicated support') }}</p>
                </div>
            </div>
        </div>
        <div class="ps-footer__content">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        @if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                            @php $stt = 1; @endphp
                            @foreach(json_decode($list_widget_footers) as $item)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <aside class="widget widget_footer">
                                        <h4 class="widget-title">{{ $item->title }}</h4>
                                        {!! clean($item->content) !!}
                                    </aside>
                                </div>
                                @php $stt++; @endphp
                                @if($stt > 3) @break @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 footer-newsletter">
                    <div class="widget newsletter-form">
                        <h4 class="widget-title">Newsletter</h4>
                        <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bravo-subscribe-form bravo-form">
                            @csrf
                            <div class="mc4wp-form-fields">
                                <input type="email" name="email" placeholder="Email Address">
                                <input type="submit" value="Subscribe">
                            </div>
                            <div class="form-mess"></div>
                        </form>
                        <div class="follow-us">
                            <p>Follow us</p>
                            <ul class="ps-list--social">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Layout::footers.parts.footer-copyright')
    </div>
</div>
