<div class="bc-contact-block {{ $class ?? '' }} my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-4 p-3">
                                <form method="post" action="{{url(app_get_locale().'/contact/store')}}"  class="bc-contact-block">
                                    {{csrf_field()}}
                                    <div style="display: none;">
                                        <input type="hidden" name="g-recaptcha-response" value="">
                                    </div>
                                    <div class="contact-form">
                                        <div class="contact-header">
                                            <h3>{{ $right_title ?? '' }}</h3>
                                        </div>
                                        <div class="contact-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <label class="label mb-1" for="name">{{ __('Full Name') }}</label>
                                                        <input type="text" value="" placeholder=" {{ __('Name') }} " name="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <label class="label mb-1" for="email">{{ __('Email') }}</label>
                                                        <input type="text" value="" placeholder="{{ __('Email') }}" name="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label class="label mb-1" for="message">{{ __('Message') }}</label>
                                                        <textarea name="message" cols="40" rows="10" class="form-control textarea" placeholder="{{ __('Message') }}"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{recaptcha_field('contact')}}
                                            </div>
                                            <p>
                                                <button class="submit btn btn-primary " type="submit">
                                                    {{ __('Send Message') }}
                                                    <i class="fa fa-spinner fa-pulse fa-fw d-none"></i>
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-mess"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap bg-main w-100 p-md-4 p-3 c-white">
                                <h3>{{ $title ?? '' }}</h3>
                                <p class="mb-4">{{ $sub_title ?? '' }}</p>
                                <div class="ibox w-100 mb-2 d-flex align-items-start">
                                    <div class="icon d-flex align-items-center justify-content-center me-2 mt-1">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p class="mb-0">
                                            <span>{{ __('Address') }}:</span>
                                            {{ $address ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="ibox w-100 mb-2 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center me-2">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p class="mb-0">
                                            <span>{{ __('Phone') }}:</span>
                                            <a href="{{ $phone ? "tel:$phone" : "" }}">{{ $phone ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="ibox w-100 mb-2 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center me-2">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p class="mb-0">
                                            <span>{{ __('Email') }}:</span>
                                            <a href="{{ $email ? "mailto:$email" : '' }}">{{ $email ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="ibox w-100 mb-2 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center me-2">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p class="mb-0">
                                            <span>{{ __('Website') }}:</span>
                                            <a href="{{ $website ?? '' }}">{{ $website ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
