@extends("layouts.app")
@section('content')
    @include('global.bc')
    <div class="bc-page--shop" id="shop-sidebar">
        <div class="container">
            <form action="" class="bc_form_filter">
                <div class="bc-layout--shop">
                    <div class="bc-layout__left">
                        @include("product.sidebar")
                    </div>
                    <div class="bc-layout__right">
                        <div class="bc-shopping bc-tab-root">
                            @include("product.search.header")
                            @include("product.search.loop")
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
