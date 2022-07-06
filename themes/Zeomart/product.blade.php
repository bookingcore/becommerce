@extends("layouts.app")
@push('head')
    <link href="{{ theme_url('/zeomart/dist/css/product.css') }}" rel="stylesheet">
@endpush
@section('content')
     @include('global.breadcrumb')
    <div class="bc-page--shop" id="shop-sidebar">
        <div class="m-auto max-w-7xl">
            @includeWhen(View::exists('product.layouts.layout-'.$layout), 'product.layouts.layout-'.$layout)
        </div>
    </div>
@endsection
