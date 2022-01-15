@extends("layouts.app")
@section('content')
    <section class="page-title">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{home_url()}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{__("Checkout")}}</li>
                </ol>
            </nav>
            <div class="section-title my-4">
                <h3>{{__('Checkout')}}</h3>
            </div>
        </div>
    </section>
    <div class="checkout-page" id="bravo-checkout-page" v-cloak>
        <div class="container">
            @if(\Modules\Order\Helpers\CartManager::count())
            <div class="row">
                <div class="column col-lg-8 col-md-12 col-sm-12">
                    @include ('order.checkout.billing')
                </div>
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    @include ('order.checkout.review')
                    <div class="payment-box">
                        <div class="payment-options">
                            @include ('order.checkout.payment')
                            <hr>
                            @php
                                $term_conditions = setting_item('booking_term_conditions');
                            @endphp

                            <div class="form-group mb-4">
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
                            <p class="alert mt-1" v-show=" message.content" v-html="message.content" :class="{'alert-danger':!message.type,'alert-success':message.type}"></p>

                            <div class="form-actions">
                                <button class="btn btn-primary" @click="doCheckout">{{__('Place Order')}}
                                    <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-warning">{{__("Your cart is empty!")}}</div>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ theme_url('Base/order/checkout.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection
