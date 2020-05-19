@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.version')) }}" rel="stylesheet">
@endsection
@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">{{__('Checkout')}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page" >
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="form-title">{{__('CHECKOUT')}}</h3>
                         <div class="booking-form">
                             @include ('Booking::frontend/booking/checkout-form')

                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="booking-detail">
                            @include ('Booking::frontend.checkout.detail')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('module/booking/js/checkout.js') }}"></script>
@endsection
