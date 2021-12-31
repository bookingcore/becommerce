<form class="form bravo-form-register bravo-form ps-form--account {{$class ?? ''}}" method="post">
    @csrf
    <div class="ps-form__content">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("First Name")}}">
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Last Name")}}">
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email *">
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password *">
            <span class="invalid-feedback error error-password"></span>
        </div>
        <div class="form-group">
            <label for="term2">
                <input id="term2" type="checkbox" name="term" class="mr5">
                {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
                <span class="checkmark fcheckbox"></span>
            </label>
            <div><span class="invalid-feedback error error-term"></span></div>
        </div>
        @if(setting_item("user_enable_register_recaptcha"))
            <div class="form-group">
                {{recaptcha_field($captcha_action ?? 'register')}}
            </div>
        @endif
        <div class="error message-error invalid-feedback"></div>
        @include("admin.message")
        <div class="form-group">
            <button type="submit" class="ps-btn ps-btn--fullwidth form-submit">
                {{ __('Sign Up') }}
                <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    @include("auth.social")
    <div class="c-grey f14 text-center mb-5">
       {{__(" Already have an account?")}}
        <a href="#" data-target="#login" data-toggle="modal">{{__("Log In")}}</a>
    </div>
</form>
