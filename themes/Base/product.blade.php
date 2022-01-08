@extends("layouts.app")
@section('content')
    @include('global.bc')
    <div class="bc-page--shop" id="shop-sidebar">
        <div class="container">
            <form action="" class="bc_form_filter">
                <div class="row">
                    <div class="col-md-3">
                        @include("product.sidebar")
                    </div>
                    <div class="col-md-9">
                        @include("product.search.header")
                        <div class="row py-3">
                            @foreach($rows as $row)
                                <div class="col-sm-4 mb-3">
                                    @include("product.search.loop")
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
