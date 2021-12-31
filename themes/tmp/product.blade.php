@extends("layouts.app")
@section('content')
    @include('global.bc')
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
