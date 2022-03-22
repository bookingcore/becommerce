@extends('layouts.app')

@section('content')
    <div class="axtronic-page--my-account bg-f1f1f1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 py-5 ">
                    <div class="bg-white p-4">
                        @include("auth.login-form",['form_title'=>__('Log In Your Account')])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
