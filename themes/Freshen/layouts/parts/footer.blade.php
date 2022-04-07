<section class="footer_one home{{ setting_item('freshen_footer_style') }}">
    <div class="footer_top_img"></div>
    <div class="container pb70">
        <div class="bc-newsletter">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="mailchimp_widget mb30-md">
                        <div class="icon float-start"><span class="flaticon-email-1"></span></div>
                        <div class="details">
                            <h3 class="title">{{ __('SIGN UP FOR NEWSLETTER') }}</h3>
                            <p class="para">{{ __("Subscribe to the weekly newsletter for all the latest updates") }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="footer_social_widget">
                        <form action="{{ route('newsletter.subscribe') }}" class="footer_mailchimp_form bc-subscribe-form">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <input type="email" class="form-control" name="email" placeholder="{{ __("Your Email...") }}" >
                                    <button class="btn miw-120 btn-primary d-flex align-items-center" type="submit">
                                        {{ __("Subscribe") }}
                                        <i class="fa fa-spinner fa-pulse fa-fw d-none"></i>
                                    </button>
                                </div>
                                <div class="mt-1">
                                    <div class="form-mess mt-1 fs-12"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt100">
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="footer_about_widget">
                    <div class="logo mb40">
                        <img src="images/footer-logo.svg" alt="footer-logo.svg">
                    </div>
                    <p>Collins Street West, Victoria <br> 8007, Australia.</p>
                    <a href="#" class="shop_map_btn">SHOW ON MAP</a>
                </div>
                <div class="footer_social_widget mt30">
                    <ul class="mb0">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 col-xl-3">
                <div class="footer_contact_widget">
                    <h4>NEED HELP</h4>
                    <ul class="list-unstyled">
                        <li class="text-white df"><span class="flaticon-phone-call"></span><a class="phone" href="#">00 0392 96 32</a></li>
                        <li class="text-white"><a href="#">Monday - Friday : 9:00 - 20:00</a></li>
                        <li class="text-white"><a href="#">Saturday: 11:00 - 14:00</a></li>
                        <li class="text-white"><span class="flaticon-email"></span><a href="#">oder@freshen.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-2 col-lg-2 col-xl-2">
                <div class="footer_qlink_widget">
                    <h4>INFORMATION</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Affilate</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
                <div class="footer_qlink_widget">
                    <h4>ACCOUNT</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Order History</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
                <div class="footer_qlink_widget">
                    <h4>OUR STORES</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">New York</a></li>
                        <li><a href="#">London SF</a></li>
                        <li><a href="#">Cockfosters BP</a></li>
                        <li><a href="#">Los Angeles</a></li>
                        <li><a href="#">Chicago</a></li>
                        <li><a href="#">Las Vegas</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container pt20 pb20">
        <div class="row">
            <div class="col-md-6 col-lg-8 col-xl-9">
                <div class="copyright-widget mb15-767">
                    <p>{{ setting_item('copyright') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="payment_getway_widget text-end">
                    {{--<img src="images/resource/payment-getway.png" alt="payment-getway.png">--}}
                </div>
            </div>
        </div>
    </div>
</section>