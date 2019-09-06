<div class="product-item clearfix">
    <div class="product-thumbnail">
        <a href="{{$row->getDetailUrl()}}" tabindex="0">
            <img src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2013/06/14a-300x300.jpg" data-original="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2013/06/14a-300x300.jpg" alt="" class="" width="300" height="300" style="display: block;">
            @if(!empty($row->discount_percent))
                <span class="ribbons"><span class="onsale ribbon"><span class="sep">-</span>{{$row->discount_percent}}</span></span>
            @endif
        </a>
    </div>
    <div class="product-item-inner">
        <div class="product-content">
            <div class="vendor-name">
                <div class="sold-by-meta"><span class="sold-by-label"></span><a href="http://demo2.drfuri.com/martfury3/vendor/iclever/" tabindex="0">Robert’s Store</a></div>
            </div>
            <h2><a href="{{$row->getDetailUrl()}}" tabindex="0">{{$row->title}}</a></h2>
        </div>
        <div class="product-price-box">
            @include('Product::frontend.details.price')
        </div>
    </div>
</div>