<form class="bc-form bc-form-register {{$class ?? ''}}" method="post">
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
            <button type="submit" class="btn btn-primary btn-lg form-submit">
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
