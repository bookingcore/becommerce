@extends('layouts.app')
@section('content')
    <div class="axtronic-page--my-account">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 py-5 ">
                    <h3 class="">{{ __('Reset Password') }}</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="label">{{__('E-Mail Address')}} <span class="required">*</span></label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-3  d-grid">
                            <button type="submit" class="btn btn-lg">{{ __('Send Password Reset Link') }} </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
