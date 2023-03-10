<nav aria-label="breadcrumb" class="axtronic-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </div>
</nav>
<div class="axtronic-contact-block {{ $class ?? '' }}">
    <div class="container">
        <div class="text-center">
            <h2 class="mb-0">{{ $title ?? '' }}</h2>
            <p class="mb-4">{{ $sub_title ?? '' }}</p>
        </div>
        <div class="contact-box-icon">
            <div class="row">
                <div class="col-md-4">
                    <div class="ibox d-flex align-items-start justify-content-start">
                        <div class="icon">
                            <a href="#"><i class="axtronic-icon-map-marker-check"></i></a>
                        </div>
                        <div class="text">
                            <h3><span>{{ __('Address') }}:</span></h3>
                            <p class="mb-0">
                                {{ $address ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox d-flex align-items-start justify-content-start">
                        <div class="icon">
                            <a href="#"><i class="axtronic-icon-call-calling2"></i></a>
                        </div>
                        <div class="text">
                            <h3><span>{{ __('Contact') }}:</span></h3>
                            <p class="mb-0">
                                <a class="c-white" href="{{ $phone ? "tel:$phone" : "" }}"><span>{{ __('Mobile: ') }}</span> <strong>{{ $phone ?? '' }}</strong></a>
                                <br>
                                <a class="c-white" href="{{ $website ? "$website" : "" }}"><span>{{ __('Website: ') }}</span> <strong>{{ $website ?? '' }}</strong></a>
                                <br>
                                <a class="c-white" href="{{ $email ? "mailto:$email" : "" }}"><span>{{ __('E-mail: ') }}:</span> <strong class="primary-color">{{ $email ?? '' }}</strong></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox d-flex align-items-start justify-content-start">
                        <div class="icon">
                            <a href="#"><i class="axtronic-icon-home"></i></a>
                        </div>
                        <div class="text ">
                            <h3><span>{{ __('Hour of operation') }}</span></h3>
                            <p class="mb-0">
                                {{ __('Monday - Friday: ') }} <strong>{{ $open_door_1 ?? '' }}</strong><br>
                                {{ __('Saturday & Sunday: ') }} <strong>{{ $open_door_2 ?? '' }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="axtronic-maps">
        <iframe src="{{ $iframe_map ?? '' }}"  allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-7">
                    <div class="contact-wrap w-100">
                        <form method="post" action="{{url(app_get_locale().'/contact/store')}}">
                            {{csrf_field()}}
                            <div style="display: none;">
                                <input type="hidden" name="g-recaptcha-response" value="">
                            </div>
                            <div class="contact-form">
                                <div class="contact-header text-center">
                                    <h3>{{ $right_title ?? '' }}</h3>
                                    <p>{{ $sub_right_title ?? '' }}</p>
                                </div>
                                <div class="contact-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" value="" placeholder=" {{ __('Your name here') }} " name="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" value="" placeholder="{{ __('Your Email') }}" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-4">
                                            <div class="form-group mb-3">
                                                <textarea name="message" cols="20" rows="5" class="form-control textarea" placeholder="{{ __('Message') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{recaptcha_field('contact')}}
                                    </div>
                                    <p>
                                        <button class="submit btn " type="submit">
                                            {{ __('Submit') }}
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div class="form-mess"></div>
                        </form>
                    </div>
                    <div class="contact-social">
                        <div class="title-social">{{ __("Connect with social media") }}</div>
                        <div class="divider-social"></div>
                        <div class="icon-social">
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="axtronic-icon-facebook"></i></a></li>
                                <li><a href="#"><i class="axtronic-icon-twitter"></i></a></li>
                                <li><a href="#"><i class="axtronic-icon-instagram"></i></a></li>
                                <li><a href="#"><i class="axtronic-icon-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
