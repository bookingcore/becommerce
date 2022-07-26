<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">

    <div class="form-group row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$request->email) }}" required autofocus>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="password" class="label">{{__('Password?')}} <span class="required">*</span></label>
        <input id="password" class="form-control" type="password" name="password">
        <p class="error-password"></p>
    </div>
    <div class="form-group mb-3">
        <label for="password_confirmation" class="label">{{__('Confirm Password?')}} <span class="required">*</span></label>
        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
        <p class="error-password"></p>
    </div>
    <div class="form-group mb-3 ">
        <button type="submit" class="btn"><span>{{__('Reset Password')}}</span> </button>
    </div>
</form>
