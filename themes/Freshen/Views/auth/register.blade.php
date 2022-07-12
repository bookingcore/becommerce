@extends('layouts.app')

@section('content')
    <div class=" bg-f1f1f1">
        <div class="container">
            <div class="row justify-content-center bravo-login-form-page bravo-login-page">
                <div class="col-md-5 py-5">
                    <div class="bg-white p-4">
                        <h4 class="form-title mb-3">{{ __('Register') }}</h4>
                        @include('auth.register-form',['captcha_action'=>'register_normal'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
