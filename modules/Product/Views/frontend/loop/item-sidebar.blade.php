<div class="product-item clearfix">
    <div class="product-thumbnail">
        <a href="{{$row->getDetailUrl()}}" tabindex="0">
            {!! get_image_tag($row['image_id']) !!}
        </a>
    </div>
    <div class="product-item-inner">
        <div class="product-content">
            <a href="{{$row->getDetailUrl()}}" tabindex="0">{{$row->title}}</a>
        </div>
        <div class="product-price-box">
            @include('Product::frontend.details.price')
        </div>
    </div>
</div>
