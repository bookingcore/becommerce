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
                        <h4 class="breadcrumb_title">{{__('Cart')}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bravo-booking-page padding-content " >
        <div class="container">
            <div id="bravo-cart-page" >
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-xl-8">
                         <div class="booking-form">
                             @include ('Booking::frontend.cart.form')
                         </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="booking-detail">
                            @include ('Booking::frontend.checkout.detail',['hide_list'=>true])
                            <div class="ui_kit_button payment_widget_btn">
                                <a href="{{route('booking.cart')}}" class="btn dbxshad btn-lg btn-thm3 circle btn-block">{{__('Proceed To Checkout') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('module/booking/js/cart.js') }}"></script>
@endsection