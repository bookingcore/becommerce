@extends('layouts.app')

@section('content')
    <div class="axtronic-page--my-account">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 py-5 ">
                    <div class="bg-white p-4">

                        <h3 class="">{{ __('Login Page') }}</h3>
                        @include("auth.login-form",['form_title'=>__('Log In Your Account')])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
