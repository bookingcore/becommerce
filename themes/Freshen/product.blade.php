@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <div class="bc-page--shop our-listing pt-100" id="shop-sidebar">
        <div class="container">
            @includeWhen(View::exists('product.layouts.layout-'.$layout), 'product.layouts.layout-'.$layout)
            @includeUnless(View::exists('product.layouts.layout-'.$layout), 'product.layouts.layout-2')
        </div>
    </div>
@endsection
