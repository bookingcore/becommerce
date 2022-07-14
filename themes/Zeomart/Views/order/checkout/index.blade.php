@extends("layouts.app")
@section('content')
    @includeWhen(!is_api(),'global.breadcrumb')
    <section class="shop-checkouts fs-14" id="bravo-checkout-page" v-cloak>
        <div class="container checkout_form ">
            <h1 class="mb-3 font-bold text-xl">{{__("Checkout")}}</h1>
            <div class="grid grid-cols-12 gap-6 checkout_coupon">
                <div class="form2 col-span-12 md:col-span-8">
                    @if(!auth()->check() and !is_api())
                        <p>{{__('Returning customer?')}} <a  class="hover:cursor-pointer font-semibold my-3" data-bs-toggle="modal" data-bs-target="#login">{{__('Click here to login')}}</a></p>
                    @endif
                    @include ('order.checkout.billing')
                    @include ('order.checkout.shipping')
                </div>
                <div class="column col-span-12 md:col-span-4">
                    <div class="order_sidebar_widget mb30">
                        @include ('order.checkout.review')
                        @include ('order.checkout.coupon')
                        <div class="payment-box">
                            <div class="payment-options">
                                @include ('order.checkout.payment')
                                @php
                                    $term_conditions = setting_item('booking_term_conditions');
                                @endphp

                                <div class="form-group my-4">
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
                                <p class="alert text-red-400 mt-1" v-show=" message.content" v-html="message.content" :class="{'alert-danger':!message.type,'alert-success':message.type}"></p>

                                <div class="ui_kit_button payment_widget_btn">
                                    <button type="button" class="rounded font-medium inline-block w-full mt-4 py-4 text-center bg-yellow-400 hover:bg-yellow-500" @click="doCheckout">{{__('PLACE ORDER')}}
                                        <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('footer')
    <script>
        var bc_order_data = {!!  json_encode( new \Modules\Order\Resources\Frontend\OrderResource( $cart ) )  !!};
        BC.routes.checkout = {
            process:'{{route(is_api() ? 'checkout.api.process' : 'checkout.process',['code'=>$cart->code])}}'
        }
    </script>
    <script src="{{ theme_url('Base/order/cart.js') }}"></script>
    <script src="{{ theme_url('Base/order/checkout.js') }}"></script>
    <script type="text/javascript">
    </script>
@endpush
