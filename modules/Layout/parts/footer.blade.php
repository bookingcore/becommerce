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
                                <input type="email" name="email" placeholder="Email Address">
                                <input type="submit" value="Subscribe">
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
                                        {!! $item->content  !!}
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
                {!! setting_item_with_lang('footer_categories') !!}
            </div>
        </div>
        <div class="copy-right footer-bottom">
            <div class="row footer-row">
                <div class="col-footer-copyright col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copyright">{!! setting_item_with_lang("footer_text_left") ?? ''  !!}</div>

                </div>
                <div class="col-footer-payments col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-payments">
                        <div class="text">
                            {!! setting_item_with_lang("footer_text_right") ?? ''  !!}
                        </div>
                        <ul class="payments">
                            <li>
                                <img width="45" height="22" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p1.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p1.jpg" data-was-processed="true"><noscript>
                                 <img width="45" height="22" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p1.jpg" class="attachment-full size-full" alt="" />
                                </noscript>
                            </li>
                            <li>
                                <img width="44" height="27" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p2.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p2.jpg" data-was-processed="true">
                                <noscript>
                                <img width="44" height="27" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p2.jpg" class="attachment-full size-full" alt="" /></noscript>
                            </li>
                            <li>
                                <img width="44" height="27" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p3.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p3.jpg" data-was-processed="true">
                                <noscript>
                                    <img width="44" height="27" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p3.jpg" class="attachment-full size-full" alt="" />
                                </noscript></li><li><img width="46" height="15" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p4.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p4.jpg" data-was-processed="true">
                                <noscript>
                                    <img width="46" height="15" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p4.jpg" class="attachment-full size-full" alt="" />
                                </noscript></li><li><img width="45" height="14" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p5.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p5.jpg" data-was-processed="true">
                                <noscript>
                                    <img width="45" height="14" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p5.jpg" class="attachment-full size-full" alt="" />
                                </noscript>
                            </li>
                            <li>
                                <img width="46" height="13" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p6.jpg" class="attachment-full size-full lazyloaded" alt="" data-lazy-src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p6.jpg" data-was-processed="true">
                                <noscript>
                                    <img width="46" height="13" src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2017/12/p6.jpg" class="attachment-full size-full" alt="" />
                                </noscript>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Layout::parts/login-register-modal')
@include('Layout::parts/chat')
@if(Auth::id())
    @include('Media::browser')
@endif
<link rel="stylesheet" href="{{asset('libs/flags/css/flag-icon.min.css')}}" >

{!! \App\Helpers\Assets::css(true) !!}

{{--Lazy Load--}}
<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script>
    // Set the options to make LazyLoad self-initialize
    window.lazyLoadOptions = {
        elements_selector: ".lazy",
        // ... more custom settings?
    };

    // Listen to the initialization event and get the instance of LazyLoad
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
