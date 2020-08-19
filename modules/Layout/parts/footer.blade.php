<div class="bravo_footer site-footer">
    <div class="footer-newsletter">
        <div class="martfury-container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col-newsletter-content">
                    <div class="newsletter-content">
                        <h3>{{ __('Newsletter') }}</h3>
                        {{__('Subcribe to get information about products and coupons')}}
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="newsletter-form">
                        <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bravo-subscribe-form bravo-form">
                            @csrf
                            <div class="mc4wp-form-fields">
                                <input type="email" name="email" placeholder="{{__('Email Address')}}">
                                <input type="submit" value="{{__('Subscribe')}}">
                            </div>
                            <div class="form-mess"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="martfury-container">
        <div class="footer-content">
            <div class="footer-widgets" id="footer-widgets">
                @if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                    <?php $list_widget_footers = json_decode($list_widget_footers); $stt = 1;?>
                    @foreach($list_widget_footers as $key=>$item)
                            <div class="footer-sidebar footer-{{$stt}}">
                                <div id="custom_html-6" class="widget_text widget widget_custom_html">
                                    <h4 class="widget-title">{{$item->title}}</h4>
                                    <div class="textwidget custom-html-widget">
                                        {!! clean($item->content)  !!}
                                    </div>
                                </div>
                                @if($stt == 1)
                                <div id="social-links-widget-2" class="widget social-links-widget social-links">
                                    <div class="social-links-list">
                                        <a href="#" class="share-facebook tooltip-enable share-social" rel="nofollow" title="Facebook" data-toggle="tooltip" data-placement="top" target="_blank">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="share-twitter tooltip-enable share-social" rel="nofollow" title="Twitter" data-toggle="tooltip" data-placement="top" target="_blank">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="share-googleplus tooltip-enable share-social" rel="nofollow" title="Google Plus" data-toggle="tooltip" data-placement="top" target="_blank">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="share-youtube tooltip-enable share-social" rel="nofollow" title="Youtube" data-toggle="tooltip" data-placement="top" target="_blank">
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="share-instagram tooltip-enable share-social" rel="nofollow" title="Instagram" data-toggle="tooltip" data-placement="top" target="_blank">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <?php $stt++; ?>
                    @endforeach
                @endif
            </div>

            <div class="footer-links" id="footer-links">
                {!! clean(setting_item_with_lang('footer_categories')) !!}
            </div>
        </div>
        <div class="copy-right footer-bottom">
            <div class="row footer-row">
                <div class="col-footer-copyright col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copyright">{!! clean(setting_item_with_lang("footer_text_left") ?? '')  !!}</div>

                </div>
                <div class="col-footer-payments col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-payments">
                        {!! clean(setting_item_with_lang("footer_text_right") ?? '')  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Layout::parts.footer-menu')
</div>

@include('Layout::parts/login-register-modal')
@include('Layout::parts/chat')
@if(Auth::id())
    @include('Media::browser')
@endif
<link rel="stylesheet" href="{{asset('libs/flags/css/flag-icon.min.css')}}" >

{!! \App\Helpers\Assets::css(true) !!}

<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script>

    window.lazyLoadOptions = {
        elements_selector: ".lazy",
    };

    window.addEventListener('LazyLoad::Initialized', function (event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);


</script>
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('libs/jquery_ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('libs/vue/vue.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
<script src="{{asset('libs/daterange/moment.min.js')}}"></script>
<script src="{{asset('libs/daterange/daterangepicker.min.js')}}"></script>
@if(Auth::id())
    <script src="{{ asset('module/media/js/browser.js?_ver='.config('app.version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>
<script src="{{ asset('libs/slimScroll/jquery.slimscroll.min.js') }}" ></script>
<script src="{{ asset('libs/slick/slick.min.js') }}" ></script>
<script src="{{ asset('js/functions.js?_ver='.config('app.version')) }}"></script>

@if(setting_item('inbox_enable'))
    <script src="{{ asset('module/core/js/chat-engine.js?_ver='.config('app.version')) }}"></script>
@endif
<script src="{{ asset('js/home.js?_ver='.config('app.version')) }}"></script>

@if(!empty($is_user_page))
    <script src="{{ asset('module/user/js/user.js?_ver='.config('app.version')) }}"></script>
@endif

{!! \App\Helpers\Assets::js(true) !!}

@yield('footer')

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp
