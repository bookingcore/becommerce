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
                                <h3>{{$page_title}}</h3>
                            </div>
                            <div class="ps-section__content">
                                @switch($type)
                                    @case("billing") @include("user.address.billing-form") @break
                                    @case("shipping") @include("user.address.shipping-form") @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
