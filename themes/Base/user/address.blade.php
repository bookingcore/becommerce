@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="bc-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bc-section__right">
                        @include('global.message')
                        <div class="bc-section--account-setting">
                            <div class="bc-section__header">
                                <h3>{{__('Address')}}</h3>
                            </div>
                            <div class="bc-section__content">
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
        </div>
    </div>
@endsection
