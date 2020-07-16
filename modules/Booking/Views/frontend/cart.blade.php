@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.version')) }}" rel="stylesheet">
@endsection
@section('content')
    <div class="bravo-booking-page padding-content " >
        <div class="container">
            <div class="ps-section__header">
                <h1>{{__('Shopping Cart')}}</h1>
            </div>

            <div class="bravo-notices-wrapper">
                <div class="{{ $message['class'] ?? '' }}" role="alert">
                    {{ $message['text'] ?? '' }}
                </div>
            </div>

            <div id="bravo-cart-page">
                <div class="row">
                    @if(Cart::count() > 0)
                        <div class="col-md-12">
                            <div class="booking-form">
                                <h2 class="cart-title">{{ __('Your Cart Items') }}</h2>
                                @include ('Booking::frontend.cart.form')
                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <p class="cart-empty">{{__('Your cart is currently empty.')}}</p>
                            <p class="return-to-shop">
                                <a class="button wc-backward" href="{{url('/')}}">
                                    {{ __('Return to shop') }}
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
