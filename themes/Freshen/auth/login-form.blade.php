<div class="login_form">
    <form class="bc-form bc-form-login {{$class ?? ''}}" method="POST" action="{{ route('login') }}">
        <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
        @csrf
        <div class="{{$inner_class ?? ''}}">
            <div class="form-group mb20">
                <label class="form-label">{{ __("Email address *") }}</label>
                <input class="form-control mb-1" type="email" name="email" placeholder="{{__('Email address')}}">
                <span class="invalid-feedback error error-email"></span>
            </div>
            <div class="form-group mb20">
                <label class="form-label">{{ __("Password *") }}</label>
                <input class="form-control mb-1" type="password" name="password" placeholder="{{__('Password')}}">
                <span class="invalid-feedback error error-password"></span>
            </div>
            @if(setting_item("user_enable_login_recaptcha"))
                <div class="form-group">
                    {{recaptcha_field($captcha_action ?? 'login')}}
                </div>
            @endif
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="remember-me" value="1" name="remember">
                <label for="remember-me">{{__('Remember me')}}</label>
                <a class="btn-fpswd float-end" href="{{route('password.request')}}">{{ __("Lost your password?") }}</a>
            </div>
            <button type="submit" class="btn btn-log btn-thm mt20">
                {{__('LOGIN')}}
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
            </button>
            <div class="error message-error invalid-feedback fz14"></div>
            @include("admin.message")
            @include("auth.social")
        </div>
    </form>
</div>