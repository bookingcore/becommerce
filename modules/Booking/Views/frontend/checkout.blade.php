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
                <div  class="checkout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="booking-form">
                                @include ('Booking::frontend.checkout.checkout-form')
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <div class="booking-detail">
                                @include ('Booking::frontend.checkout.detail')
                                @include ('Booking::frontend.checkout.checkout-payment')

                                @php
                                    $term_conditions = setting_item('booking_term_conditions');
                                @endphp

                                <div class="form-group">
                                    <label class="term-conditions-checkbox">
                                        <input type="checkbox" name="term_conditions"> {{__('I have read and accept the')}}  <a target="_blank" href="{{get_page_url($term_conditions)}}">{{__('terms and conditions')}}</a>
                                    </label>
                                </div>
                                @if(setting_item("booking_enable_recaptcha"))
                                    <div class="form-group">
                                        {{recaptcha_field('booking')}}
                                    </div>
                                @endif
                                <div class="html_before_actions"></div>

                                <p class="alert-text mt10" v-show=" message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></p>

                                <div class="form-actions">
                                    <button class="btn btn-success" @click="doCheckout">{{__('Place order')}}
                                        <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
                                    </button>
                                </div>
                            </div>
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
