@extends("layouts.app")
@push('head')
    <link href="{{ theme_url('/zeomart/dist/css/product.css') }}" rel="stylesheet">
@endpush
@section('content')
    <?php
        $layout = request()->query('layout',setting_item('zm_search_layout',1));
        $listing_list_style = request()->query('list_style',setting_item('zm_search_item_layout'));
    ?>
     @include('global.breadcrumb')
    <div class="bc-page--shop" id="shop-sidebar">
        <div class="container">
            @includeWhen(View::exists('product.layouts.layout-'.$layout), 'product.layouts.layout-'.$layout)
        </div>
    </div>
@endsection
@push('head')
    <script  src="{{ theme_url('Zeomart/dist/js/vendor/product-list.js?_v='.config('app.asset_version')) }}"></script>
@endpush
