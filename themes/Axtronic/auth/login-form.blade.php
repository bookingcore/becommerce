{{--<form class="axtronic-login-form-ajax" method="POST" action="{{ route('login') }}">--}}
<form class="axtronic-form-login" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div>
        <div class="">
            <div class="form-group mb-3">
                <span class="label">{{__('Username or email?')}} <span class="required">*</span></span>
                <input class="form-control" type="email" name="email" >
                <p class="error-email"></p>
            </div>
            <div class="form-group mb-3">
                <span class="label">{{__('Password?')}} <span class="required">*</span></span>
                <input class="form-control" type="password" name="password">
                <p class="error-password"></p>
            </div>
            <div class="error message-error invalid-feedback"></div>
            @include("admin.message")
            <div class="form-group mb-3  d-grid">
                <button type="submit" class="btn btn-lg">{{__('Login')}} </button>
            </div>
        </div>
    </div>
</form>
<a href="#" class="lostpass-link" title="Lost your password?">{{__("Lost your password?")}}</a>
<div class="login-form-bottom">
    <span class="create-account-text">{{__("No account yet?")}}</span>
    <a class="register-link" href="#" title="Register">{{__("Create an Account")}}</a>
</div>
