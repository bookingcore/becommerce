@extends("layouts.app")
@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}">{{__("Home")}}</a></li>
                <li>{{__('Shop')}}</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop" id="shop-sidebar">
        <div class="container">
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    @include("product.sidebar")
                </div>
                <div class="ps-layout__right">
                    <div class="ps-shopping ps-tab-root">
                        @include("product.search.header")
                        @include("product.search.loop")
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
