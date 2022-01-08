@extends('layouts.app')

@section('content')
    <div class="bc-page--my-account">
        <div class="bg-f1f1f1">
            <div class="container">
                <div class="pb-5 pt-5">
                    @include("auth.login-form",['form_title'=>__('Log In Your Account'),'class'=>'pt-0 bg-white'])
                </div>
            </div>
        </div>
    </div>
@endsection
