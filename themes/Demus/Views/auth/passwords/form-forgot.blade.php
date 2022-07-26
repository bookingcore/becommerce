<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/26/2022
 * Time: 9:19 PM
 */
?>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="email" class="label">{{__('E-Mail Address')}} <span class="required">*</span></label>
        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group mb-3  d-grid">
        <button type="submit" class="btn"><span>{{ __('Send Password Reset Link') }}</span> </button>
    </div>
</form>
