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
                {{--<div id="nav_menu-6" class="widget widget_nav_menu">
                    <h4 class="widget-title">Clothing &amp; Apparel:</h4>
                    <div class="menu-footer-link-2-container">
                        <ul id="menu-footer-link-2" class="menu">
                            <li id="menu-item-483"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-483"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/office-electronics/printers/">Printers</a>
                            </li>
                            <li id="menu-item-484"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-484"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/office-electronics/projectors/">Projectors</a>
                            </li>
                            <li id="menu-item-485"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-485"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/office-electronics/scanners/">Scanners</a>
                            </li>
                            <li id="menu-item-486"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-486"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/office-electronics/store-business/">Store
                                    &amp; Business</a></li>
                            <li id="menu-item-487"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-487"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/tv-televisions/4k-ultra-hd-tvs/">4K
                                    Ultra HD TVs</a></li>
                            <li id="menu-item-488"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-488"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/tv-televisions/led-tvs/">LED
                                    TVs</a></li>
                            <li id="menu-item-489"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-489"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/tv-televisions/oled-tvs/">OLED
                                    TVs</a></li>
                        </ul>
                    </div>
                </div>
                <div id="nav_menu-10" class="widget widget_nav_menu">
                    <h4 class="widget-title">Home, Garden &amp; Kitchen:</h4>
                    <div class="menu-footer-link-3-container">
                        <ul id="menu-footer-link-3" class="menu">
                            <li id="menu-item-2217"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2217"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/cookware/">Cookware</a>
                            </li>
                            <li id="menu-item-2218"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2218"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/decoration/">Decoration</a>
                            </li>
                            <li id="menu-item-2219"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2219"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/furniture/">Furniture</a>
                            </li>
                            <li id="menu-item-2220"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2220"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/garden-tools/">Garden
                                    Tools</a></li>
                            <li id="menu-item-2221"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2221"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/home-improvement/">Garden
                                    Equipments</a></li>
                            <li id="menu-item-2222"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2222"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/powers-and-hand-tools/">Powers
                                    And Hand Tools</a></li>
                            <li id="menu-item-2223"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2223"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/utensil-gadget/">Utensil
                                    &amp; Gadget</a></li>
                        </ul>
                    </div>
                </div>
                <div id="nav_menu-9" class="widget widget_nav_menu">
                    <h4 class="widget-title">Health &amp; Beauty:</h4>
                    <div class="menu-footer-link-5-container">
                        <ul id="menu-footer-link-5" class="menu">
                            <li id="menu-item-2232"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2232"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/health-beauty/hair-care/">Hair
                                    Care</a></li>
                            <li id="menu-item-2233"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2233"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/health-beauty/makeup/">Makeup</a>
                            </li>
                            <li id="menu-item-2234"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2234"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/health-beauty/perfumer/">Body
                                    Shower</a></li>
                            <li id="menu-item-2235"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2235"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/health-beauty/skin-care/">Skin
                                    Care</a></li>
                            <li id="menu-item-2236"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2236"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/jewelry-watches/">Cologine</a>
                            </li>
                            <li id="menu-item-2237"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2237"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/babies-moms/">Perfume</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nav_menu-8" class="widget widget_nav_menu"><h4 class="widget-title">Jewelry &amp; Watches:</h4>
                    <div class="menu-footer-link-6-container">
                        <ul id="menu-footer-link-6" class="menu">
                            <li id="menu-item-2238"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2238"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/clothing-apparel/bags/">Necklace</a>
                            </li>
                            <li id="menu-item-2239"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2239"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/clothing-apparel/sunglasses/">Pendant</a>
                            </li>
                            <li id="menu-item-2240"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2240"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/clothing-apparel/accessories-clothing-apparel/">Diamond
                                    Ring</a></li>
                            <li id="menu-item-2241"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2241"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/clothing-apparel/kids-fashion/">Sliver
                                    Earing</a></li>
                            <li id="menu-item-2242"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2242"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/audios-theaters/speakers/">Leather
                                    Watcher</a></li>
                            <li id="menu-item-2243"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2243"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/office-electronics/printers/">Rolex</a>
                            </li>
                            <li id="menu-item-2244"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2244"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/tv-televisions/4k-ultra-hd-tvs/">Gucci</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nav_menu-7" class="widget widget_nav_menu">
                    <h4 class="widget-title">Computer &amp; Technologies:</h4>
                    <div class="menu-footer-link-4-container">
                        <ul id="menu-footer-link-4" class="menu">
                            <li id="menu-item-2224"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2224"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/computers-technologies/desktop-pc/">Desktop
                                    PC</a></li>
                            <li id="menu-item-2225"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2225"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/computers-technologies/laptop/">Laptop</a>
                            </li>
                            <li id="menu-item-2226"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2226"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/computers-technologies/smartphones/">Smartphones</a>
                            </li>
                            <li id="menu-item-2227"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2227"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/audios-theaters/headphone/">Tablet</a>
                            </li>
                            <li id="menu-item-2228"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2228"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/audios-theaters/speakers/">Game
                                    Controller</a></li>
                            <li id="menu-item-2229"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2229"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/car-electronics/audio-video/">Audio
                                    &amp; Video</a></li>
                            <li id="menu-item-2230"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2230"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/car-electronics/car-security/">Wireless
                                    Speaker</a></li>
                            <li id="menu-item-2231"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2231"><a
                                    href="http://demo2.drfuri.com/martfury3/product-category/consumer-electrics/car-electronics/radar-detector/">Drone</a>
                            </li>
                        </ul>
                    </div>
                </div>--}}
            </div>
        </div>
        <div class="copy-right footer-bottom">
            <div class="row footer-row">
                <div class="col-footer-copyright col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copyright">{!! setting_item_with_lang("footer_text_left") ?? ''  !!}</div>

                </div>
                <div class="col-footer-payments col-lg-6 col-md-12 col-sm-12 col-xs-12">
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
