<form class="bravo-form-login ps-form--account m-0 p-0 mw-none" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="ps-form__content">
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email address">
        </div>
        <div class="form-group form-forgot">
            <input class="form-control" type="text" placeholder="Password"><a href="{{route('password.request')}}">{{__('Forgot?')}}</a>
        </div>
        @if(setting_item("user_enable_login_recaptcha"))
            <div class="form-group">
                {{recaptcha_field($captcha_action ?? 'login')}}
            </div>
        @endif
        <div class="form-group">
            <div class="ps-checkbox">
                <input class="form-control" type="checkbox" id="remember-me" name="remember">
                <label for="remember-me">{{__('Rememeber me')}}</label>
            </div>
        </div>
        <div class="form-group submtit">
            <button class="ps-btn ps-btn--fullwidth">{{__('Login')}}</button>
        </div>
    </div>
    <div class="ps-form__footer">
        <p>Connect with:</p>
        <ul class="ps-list--social">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>
    </div>
</form>
