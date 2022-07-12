<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    <p class="note">Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
    <div class="form-group mb-3">
        <span class="label">{{__('Password?')}} <span class="required">*</span></span>
        <input class="form-control" type="password" name="password">
        <p class="error-password"></p>
    </div>
    <div class="form-group mb-3">
        <span class="label">{{__('Confirm Password?')}} <span class="required">*</span></span>
        <input class="form-control" type="password" name="password_confirmation">
        <p class="error-password"></p>
    </div>
    <div class="form-group mb-3  d-grid">
        <button type="submit" class="btn btn-lg">{{__('Reset Password')}} </button>
    </div>
</form>
