<?php
$user = auth()->user();
?>
<form class="bc-form {{$class ?? ''}}" method="post" action="{{route('vendor.register.store')}}">
    <h4>{{__("Store Register")}}</h4>
    @csrf
    <div class="bc-form__content">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb-3">
                    <input type="text" required class="form-control" name="first_name" value="{{old('first_name')}}" autocomplete="off" placeholder="{{__("First Name")}}">
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group mb-3">
                    <input type="text" required class="form-control" name="last_name" value="{{old('last_name')}}" autocomplete="off" placeholder="{{__("Last Name")}}">
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="email" @if($user) readonly @endif required class="form-control" name="email" value="{{old('email')}}" autocomplete="off" placeholder="Email *">
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group mb-3">
            <input type="text" required class="form-control" name="business_name" value="{{old('business_name')}}" autocomplete="off" placeholder="{{__("Business Name")}}">
            <span class="invalid-feedback error error-business_name"></span>
        </div>
        @if(!$user)
        <div class="form-group mb-3">
            <input type="password" required class="form-control" minlength="8" name="password" autocomplete="off" placeholder="Password *">
            <span class="invalid-feedback error error-password"></span>
        </div>
        <div class="form-group mb-3">
            <input type="password" required class="form-control" minlength="8" name="password_confirmation" autocomplete="off" placeholder="Re-Password *">
            <span class="invalid-feedback error error-password_confirmation"></span>
        </div>
        @endif
        <div class="form-group mb-3">
            <label for="term2">
                <input id="term2" type="checkbox" required name="term" class="mr5">
                {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Conditions</a>",['link'=>get_page_url(setting_item('vendor_term_condition'))]) !!}
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
        @include("global.message")
        <div class="form-group mb-3 d-grid">
            <button type="submit" class="btn btn-primary btn-lg form-submit">
                {{ __('Sign Up') }}
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
            </button>
        </div>
    </div>
</form>
