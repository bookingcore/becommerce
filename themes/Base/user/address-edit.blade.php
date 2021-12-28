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
                        <form action="{{route('user.address.store',['type'=>$type])}}" method="post">
                            @csrf
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
                                <div class="form-group submit">
                                    <button class="ps-btn">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
