<form class="axtronic-form axtronic-form-register" method="post">
    @csrf
    <div class="axtronic-form__content">
        <div class="form-group mb-3">
            <label class="form-label">{{ __("First Name") }} <span class="required">*</span></label>
            <input type="text" class="form-control mb-1" name="first_name" autocomplete="off" >
            <span class="invalid-feedback error error-first_name"></span>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">{{ __("Last Name") }} <span class="required">*</span></label>
            <input type="text" class="form-control mb-1" name="last_name" autocomplete="off" >
            <span class="invalid-feedback error error-last_name"></span>
        </div>
        <div class="form-group mb-3">
            <label for="email" class="label">{{__('Email address')}} <span class="required">*</span></label>
            <input id="email" class="form-control" type="email" name="email" >
            <p class="invalid-feedback error-email error"></p>
        </div>
        <div class="form-group mb-3">
            <label for="password" class="label">{{__('Password?')}} <span class="required">*</span></label>
            <input id="password" class="form-control" type="password" name="password">
            <p class="invalid-feedback error-password error"></p>
        </div>
        <div class="form-group mb20 axtronic-checkbox">
            <input class="custom-control-input" type="checkbox" id="policy-me" value="1" name="term">
            <label for="policy-me"> {!! __("Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our  <a href=':link' target='_blank'> Privacy Policy</a>",['link'=>get_page_url(setting_item('order_term_conditions'))]) !!}</label>
            <div><span class="invalid-feedback error error-term"></span></div>
        </div>
        @if(setting_item("user_enable_register_recaptcha"))
            <div class="form-group mb20">
                {{recaptcha_field($captcha_action ?? 'register')}}
            </div>
        @endif
        @include("admin.message")

        <div class="form-group my-3 d-grid">
            <button type="submit" class="btn btn-signup form-submit">{{__('Sign Up')}}  <i class="fa fa-spinner icon-loading fa-pulse fa-fw"></i></button>
        </div>
    </div>
    @include("auth.social")
</form>
