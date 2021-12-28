@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="ps-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ps-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ps-section__right">
                        <div class="ps-section--account-setting">
                            <div class="ps-section__header">
                                <h3>{{__('Address')}}</h3>
                            </div>
                            <div class="ps-section__content">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <figure class="ps-block--address">
                                            <figcaption>{{__('Billing address')}}</figcaption>
                                            <div class="ps-block__content">
                                                <p>You Have Not Set Up This Type Of Address Yet.</p><a href="edit-address.html">Edit</a>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <figure class="ps-block--address">
                                            <figcaption>Shipping address</figcaption>
                                            <div class="ps-block__content">
                                                <p>You Have Not Set Up This Type Of Address Yet.</p><a href="edit-address.html">Edit</a>
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
