@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <div class="checkout-page mb-5" id="bravo-checkout-page" v-cloak>
        <div class="container">
            <h1 class="mb-3">{{__("Checkout")}}</h1>
            @if(\Modules\Order\Helpers\CartManager::count())
            <div class="row">
                <div class="column col-lg-8 col-md-12 col-sm-12">
                    @if(!auth()->check())
                        <div class="card mb-4">
                            <div class="card-header">
                                {{__("Already have an account?")}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{__('Login to save your order')}}</h5>
                                <a data-bs-toggle="modal" data-bs-target="#login" class="btn btn-primary">{{__("Login now")}}</a>
                            </div>
                        </div>
                    @endif
                    @include ('order.checkout.billing')
                    @include ('order.checkout.shipping')
                </div>
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    @include ('order.checkout.review')
                    @include ('order.checkout.coupon')
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
    <script>
        var axtronic_order_data = {!!  json_encode( new \Modules\Order\Resources\Frontend\OrderResource( new \Modules\Order\Helpers\CartManager ) )  !!};
        BC.routes.checkout = {
            process:'{{route('checkout.process')}}'
        }
    </script>
    <script src="{{ theme_url('Axtronic/order/cart.js') }}"></script>
    <script src="{{ theme_url('Axtronic/order/checkout.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection
