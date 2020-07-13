@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.version')) }}" rel="stylesheet">
@endsection
@section('content')
    <section class="inner_page_breadcrumb">
        <div class="breadcrumb_content">
            <h1 class="breadcrumb_title">{{__('Checkout')}}</h1>
        </div>
    </section>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page">
                <form action="#" method="post" class="checkout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="booking-form">
                                @include ('Booking::frontend/booking/checkout-form')
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <div class="booking-detail">
                                @include ('Booking::frontend.checkout.detail')
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('module/booking/js/checkout.js') }}"></script>
@endsection
