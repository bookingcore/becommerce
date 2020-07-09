@extends('layouts.app')

@section('content')
<div class="page-profile-content page-template-content">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    @include('User::frontend.profile.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="bravo_profile_content">
                        @if(!empty($products))
                            <div class="shop-toolbar">
                                <div class="products-found">
                                    <strong>{{ $products->total() }}</strong>{{__('Products found')}}
                                </div>
                                <div class="shop-view">
                                    <span>View</span>
                                    <a href="#" class="grid-view mf-shop-view current" data-view="grid">
                                        <i class="icon-grid"></i>
                                    </a>
                                    <a href="#" class="list-view mf-shop-view " data-view="list">
                                        <i class="icon-list4"></i>
                                    </a>
                                </div>
                                <a href="#" class="mf-filter-mobile" id="mf-filter-mobile">
                                    <i class="icon-equalizer"></i><span>Filter</span>
                                </a>
                            </div>
                            <ul class="products list-unstyled row">
                                @if($products->total() > 0)
                                    @foreach($products as $row)
                                        @include('Product::frontend.layouts.product')
                                    @endforeach
                                @endif
                            </ul>
                            <div class="clearfix"></div>
                            <nav class="woocommerce-pagination">
                                {{ $products->links() }}
                            </nav>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('User::frontend.profile.services')
</div>
@endsection
