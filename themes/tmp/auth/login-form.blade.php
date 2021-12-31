<form class="bravo-form-login bravo-form ps-form--account {{$class ?? ''}}" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="{{$inner_class ?? ''}}">
        <div class="ps-form__content">
            @if(!empty($form_title))
                <h5>{{$form_title}}</h5>
            @endif
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email address">
            </div>
            <div class="form-group form-forgot">
                <input class="form-control" type="password" name="password" placeholder="Password"><a href="{{route('password.request')}}">{{__('Forgot?')}}</a>
            </div>
            @if(setting_item("user_enable_login_recaptcha"))
                <div class="form-group">
                    {{recaptcha_field($captcha_action ?? 'login')}}
                </div>
            @endif
            <div class="form-group">
                <div class="ps-checkbox">
                    <input class="form-control" type="checkbox" id="remember-me" value="1" name="remember">
                    <label for="remember-me">{{__('Remember me')}}</label>
                </div>
            </div>
            <div class="error message-error invalid-feedback"></div>

            @include("admin.message")
            <div class="form-group submtit">
                <button class="ps-btn ps-btn--fullwidth">{{__('Login')}}
                    <i class="fa fa-spinner fa-pulse fa-fw"></i>
                </button>
            </div>
        </div>
        @include("auth.social")
    </div>
</form>
