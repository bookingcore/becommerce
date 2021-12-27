@extends('layouts.blank')
@section('content')
    <div id="pos_app" v-cloak>
        <div class="container-fluid">
            <div class="pos-header"></div>
            <div class="row">
                <div class="col-md-7">
                    <div class="pos-products">
                        <pos-products @add="addProduct"></pos-products>
                    </div>
                </div>
                <div class="col-md-5">

                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('POS.components.products')
    @include('POS.components.order-items')
    @include('POS.components.order-payment')
    <script src="{{theme_url('Base/pos/pos.js')}}"></script>
@endsection
