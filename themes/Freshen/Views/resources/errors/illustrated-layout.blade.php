@extends('layouts.app')
@section('content')
    <section class="our-error bg-ptrn5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="error_page footer_apps_widget">
                        <div class="code fz130"><h1>@yield('code', __('Oh no'))</h1></div>
                        <h2>{{ __("Oops...") }}</h2>
                        <p>@yield('message')</p>
                    </div>
                    <a class="btn_error btn-thm" href="{{ app('router')->has('home') ? route('home') : url('/') }}">{{ __('BACK HOMEPAGE') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection