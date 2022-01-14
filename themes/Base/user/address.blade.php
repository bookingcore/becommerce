@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-section-account mb-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="fs-24 mb-3">
                        <h3>{{__("Orders")}}</h3>
                    </div>
                    <div class="bc-content">
                        @include('global.message')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <figure class="bc-block--address">
                                    <figcaption>{{__('Billing address')}}</figcaption>
                                    <div class="bc-block__content">
                                        @if(empty($billing))
                                            <p>{{__('You Have Not Set Up This Type Of Address Yet.')}}</p>
                                        @else
                                            <address class="font-italic">
                                                <p>
                                                    {!! $billing->html !!}
                                                </p>
                                            </address>
                                        @endif
                                        <a class="btn btn-primary btn--sm" href="{{route('user.address.detail',['type'=>'billing'])}}">{{__('Edit')}}</a>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-md-6 col-12">
                                <figure class="bc-block--address">
                                    <figcaption>{{__('Shipping address')}}</figcaption>
                                    <div class="bc-block__content">
                                        @if(empty($shipping))
                                            <p>{{__('You Have Not Set Up This Type Of Address Yet.')}}</p>
                                        @else
                                            <address class="font-italic">
                                                <p>
                                                    {!! $shipping->html !!}
                                                </p>
                                            </address>
                                        @endif
                                        <a class="btn btn-primary btn--sm" href="{{route('user.address.detail',['type'=>'shipping'])}}">{{__('Edit')}}</a>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
