@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <div class="bc-page--shop our-listing pt-100" id="shop-sidebar">
        <div class="container">
            @includeWhen(View::exists('product.layouts.'.$layout), 'product.layouts.'.$layout)
            @includeUnless(View::exists('product.layouts.'.$layout), 'product.layouts.left-sidebar')
        </div>
    </div>
@endsection

