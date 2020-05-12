@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/product/css/product.css?_ver='.config('app.version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
@endsection
@section('content')
    <div class="bravo-breadcrumbs">
        @include('Product::frontend.layouts.search.search-bc')
    </div>

    <div class="bravo_search_product">

        <div class="container">
            <div class="search-header">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        @include('Product::frontend.layouts.search.filter-search')
                    </div>
                    <!-- #secondary -->
                    <div id="primary" class="content-area col-md-9 col-sm-12 col-xs-12">
                        @include('Product::frontend.layouts.search.content-search')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/product/js/product.js?_ver='.config('app.version')) }}"></script>
@endsection
