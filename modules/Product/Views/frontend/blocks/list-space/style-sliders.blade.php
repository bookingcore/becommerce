<div class="mf-product-deals-day woocommerce mf-products-carousel bravo_style-sliders">
    <div class="cat-header">
        <div class="header-content">
            <h2 class="cat-title">{{$title ?? ''}}</h2>
        </div>
        <div class="header-link">
            @if(!empty($categories))
                @foreach($categories as $cat)
                    <li><a class="extra-link" href="{{$cat->getDetailUrl()}}">{{ $cat->name }}</a></li>
                @endforeach
            @endif
            <a href="{{ route("product.index") }}">{{__('View All')}}</a>
        </div>
    </div>
    <div class="products-content">
        <ul class="products">
            @foreach($rows as $row)
                @include('Product::frontend.layouts.product')
            @endforeach
        </ul>
    </div>
</div>
