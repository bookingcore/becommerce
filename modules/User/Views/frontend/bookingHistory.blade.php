@extends('layouts.user')
@section('head')

@endsection
@section('content')
    <h2 class="title-bar no-border-bottom">{{__("Order History")}}</h2>
    @include('Layout::admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            @if(!empty($orders))
                @include('User::frontend.order.order')
                <div class="show-modal">
                    @include('User::frontend.order.order-modal')
                </div>
            @else
                {{__("No Booking History")}}
            @endif
        </div>
    </div>
@endsection
@section('footer')

@endsection
