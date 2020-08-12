@extends('layouts.user')
@section('head')

@endsection
@section('content')
    <h2 class="title-bar no-border-bottom">{{__("Product's Order")}}</h2>
    @include('Layout::admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            @if(count($orders) > 0)
                @include('Product::frontend.vendor.order.order')
            @else
                {{__("No Order History")}}
            @endif
        </div>
    </div>
@endsection
@section('footer')

@endsection
