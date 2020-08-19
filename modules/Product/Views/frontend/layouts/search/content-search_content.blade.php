<div id="mf-catalog-toolbar" class="shop-toolbar multiple">
    <div class="products-found">{!! __('<strong>:count</strong> :product found',['count'=>$rows->total(),'product'=>($rows->total() > 0) ? 'Products' : 'Product']) !!}</div>
    <a href="#" class="mf-filter-mobile" id="mf-filter-mobile">
        <i class="icon-equalizer"></i>
        <span>{{ __('Filter') }}</span>
    </a>
    <div class="shop-view">
        <span>{{__('View')}}</span>
        <a href="#" class="grid-view mf-shop-view current" data-view="grid">
            <i class="icon-grid"></i>
        </a>
        <a href="#" class="list-view mf-shop-view" data-view="list">
            <i class="icon-list4"></i>
        </a>
    </div>
    <ul class="woocommerce-ordering">
        <li class="current"><span>{{__('Sort by average rating')}}</span>
            <ul>
                <li><a href="#" class="active">{{__('Sort by popularity')}}</a></li>
                <li><a href="#" class="">{{__('Sort by average rating')}}</a></li>
                <li><a href="#" class="">{{__('Sort by latest')}}</a></li>
                <li><a href="#" class="">{{__('Sort by price: low to high')}}</a></li>
                <li><a href="#" class="">{{__('Sort by price: high to low')}}</a></li>
            </ul>
        </li>
        <li class="cancel-ordering"><a href="#" class="mf-cancel-order">Cancel</a></li>
    </ul>
</div>
<div id="mf-shop-content" class="woocommerce mf-shop-content">
    <ul class="products list-unstyled row">
        @if($rows->total() > 0)
            @foreach($rows as $row)
                @include('Product::frontend.layouts.product')
            @endforeach
        @else
            <div class="alert alert-warning product-warring" role="alert" style="width: 100%">
                {{__('0 Product found') }}
            </div>
        @endif
    </ul>
    <div class="clearfix"></div>
    <nav class="woocommerce-pagination">
        {{ $rows->links() }}
    </nav>
</div>
