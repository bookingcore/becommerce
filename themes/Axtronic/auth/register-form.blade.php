<form class="axtronic-form axtronic-form-register" method="post">
    @csrf
    <div class="axtronic-form__content">
        <div class="form-group mb-3">
            <label for="email" class="label">{{__('Email address')}} <span class="required">*</span></label>
            <input id="email" class="form-control" type="email" name="email" >
            <p class="error-email"></p>
        </div>
        <div class="form-group mb-3">
            <label for="password" class="label">{{__('Password?')}} <span class="required">*</span></label>
            <input id="password" class="form-control" type="password" name="password">
            <p class="error-password"></p>
        </div>
        <div class="form-group mb-3">
            <label class="radio"><input type="radio" name="role" value="customer" checked="checked"> {{__("I am a customer")}} </label>
            <br>
            <label class="radio">
                <input type="radio" name="role" value="seller">
                {{__("I am a vendor")}}
            </label>
        </div>
        @include("admin.message")
        <p class="note">
         {{ __("Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our") }} <a href="#" class="woocommerce-privacy-policy-link" target="_blank">{{__("privacy policy")}}</a>.
        </p>

        <div class="form-group mb-3  d-grid">
            <button type="submit" class="btn btn-lg">{{__('Sign Up')}} </button>
        </div>
    </div>
</form>
