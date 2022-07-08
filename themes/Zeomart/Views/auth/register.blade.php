@extends('layouts.app')

@section('content')
    <div class="py-10 px-6 lg:px-8 m-auto max-w-2xl">
        <h3 class="mb-4 text-3xl font-medium text-gray-900 dark:text-white">{{ __("Create your account") }}</h3>
        @include("auth.register-form")
    </div>
@endsection
