<form class="bc-form bc-form-login {{$class ?? ''}}" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="{{$inner_class ?? ''}}">
        <div class="">
            {{--@if(!empty($form_title))--}}
                {{--<h5>{{$form_title}}</h5>--}}
            {{--@endif--}}
            <div class="form-group mb-3">
                <input class="form-control" type="email" name="email" placeholder="{{__('Email address')}}">
                <p class="error-email"></p>
            </div>
            <div class="form-group mb-3">
                <input class="form-control" type="password" name="password" placeholder="{{__('Password')}}">
                <p class="error-password"></p>
            </div>
            @if(setting_item("user_enable_login_recaptcha"))
                <div class="form-group">
                    {{recaptcha_field($captcha_action ?? 'login')}}
                </div>
            @endif
            <div class="form-group mb-3 d-flex justify-content-between">
                <div class="bc-checkbox">
                    <input class="" type="checkbox" id="remember-me" value="1" name="remember">
                    <label for="remember-me">{{__('Remember me')}}</label>
                </div>
                <a href="{{route('password.request')}}">{{__('Forgot?')}}</a>
            </div>
            <div class="error message-error invalid-feedback"></div>

            @include("admin.message")
            <div class="form-group mb-3  d-grid">
                <button class="btn">
                    <span>{{__('Login')}}</span>
                </button>
            </div>
        </div>
        @include("auth.social")
    </div>
</form>
<a href="#" class="lostpass-link" title="Lost your password?">{{__("Lost your password?")}}</a>
<div class="login-form-bottom">
    <span class="create-account-text">{{__("No account yet?")}}</span>
    <a class="register-link" href="#" title="Register">{{__("Create an Account")}}</a>
</div>
