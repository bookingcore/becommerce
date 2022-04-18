<div class="sign_up_form">
    <form class="bc-form bc-form-register {{$class ?? ''}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb20">
                    <label class="form-label">{{ __("First Name *") }}</label>
                    <input type="text" class="form-control mb-1" name="first_name" autocomplete="off" placeholder="{{__("First Name")}}">
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb20">
                    <label class="form-label">{{ __("Last Name *") }}</label>
                    <input type="text" class="form-control mb-1" name="last_name" autocomplete="off" placeholder="{{__("Last Name")}}">
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group mb20">
            <label class="form-label">{{ __("Email *") }}</label>
            <input type="email" class="form-control mb-1" name="email" autocomplete="off" placeholder="{{ __("Email") }}">
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group mb20">
            <label class="form-label">{{ __("Password *") }}</label>
            <input type="password" class="form-control mb-1" name="password" autocomplete="off" placeholder="{{ __("Password") }}">
            <span class="invalid-feedback error error-password"></span>
        </div>
        <div class="form-group mb20">
            <input class="custom-control-input" type="checkbox" id="policy-me" value="1" name="term">
            <label for="policy-me"> {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('order_term_conditions'))]) !!}</label>
            <div><span class="invalid-feedback error error-term"></span></div>
        </div>
        @if(setting_item("user_enable_register_recaptcha"))
            <div class="form-group mb20">
                {{recaptcha_field($captcha_action ?? 'register')}}
            </div>
        @endif
        <div class="error message-error invalid-feedback"></div>
        @include("admin.message")
        <div class="form-group mb-3 d-grid">
            <button type="submit" class="btn btn-signup btn-thm mb0 form-submit">
                {{ __('REGISTER') }}
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
            </button>
        </div>

    </form>
</div>

<form class="bc-form bc-form-register {{$class ?? ''}} d-none" method="post">
    @csrf
    <div class="bc-form__content">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("First Name")}}">
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Last Name")}}">
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email *">
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group mb-3">
            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password *">
            <span class="invalid-feedback error error-password"></span>
        </div>
        <div class="form-group mb-3">
            <label for="term2">
                <input id="term2" type="checkbox" name="term" class="mr5">
                {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('order_term_conditions'))]) !!}
                <span class="checkmark fcheckbox"></span>
            </label>
            <div><span class="invalid-feedback error error-term"></span></div>
        </div>
        @if(setting_item("user_enable_register_recaptcha"))
            <div class="form-group mb-3">
                {{recaptcha_field($captcha_action ?? 'register')}}
            </div>
        @endif
        <div class="error message-error invalid-feedback"></div>
        @include("admin.message")
        <div class="form-group mb-3 d-grid">
            <button type="submit" class="btn btn-signup btn-thm mb0 form-submit">
                {{ __('Sign Up') }}
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
            </button>
        </div>
    </div>
    @include("auth.social")
    <div class="c-grey f14 text-center mb-5">
       {{__(" Already have an account?")}}
        <a href="#login" data-target="#login" data-bs-toggle="modal">{{__("Log In")}}</a>
    </div>
</form>
