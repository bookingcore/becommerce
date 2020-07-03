<?php
$service = $row->getService;
?>
<tr>
    <td class="product-remove item_{{$service->id}}">
        <a href="{{route('user.wishList.remove')}}?id={{$service->id}}&type={{$service->type}}" class="remove remove_from_wishlist" title="Remove this product">×</a>
    </td>
    <td class="product-thumbnail">
        <a href="{{route('product.detail',['slug'=>$service->slug])}}">
            @if($service->image_url)
                <img src="{{$service->image_url}}" class="img-responsive" alt="{{$service->title}}">
            @endif
        </a>
    </td>
    <td class="product-name">
        <a href="{{route('product.detail',['slug'=>$service->slug])}}">{{$service->title}}</a>
    </td>
    <td class="product-price">
        @if(!empty($service->sale_price))
            <p class="price has-sale">
                <ins>
                    <span class="amount">{{format_money($service->sale_price)}}</span>
                </ins>
                <del>
                    <span class="amount">{{format_money($service->price)}}</span>
                </del>
            </p>
        @else
            <p class="price">
                <span class="amount">{{format_money($service->price)}}</span>
            </p>
        @endif
    </td>
    <td class="product-stock-status">
        <span class="{{ ($service->stock_status == 'in') ? 'wishlist-in-stock' : 'wishlist-out-of-stock' }}">{{ ($service->stock_status == 'in') ? 'In Stock' : 'Out of stock' }}</span>
    </td>

    <td class="product-add-to-cart">
        @if($service->stock_status == 'in')
            <a href="#" class="button bravo_add_to_cart" data-product={"id":{{$service->id}},"type":"simple"}>
                <i class="p-icon icon-bag2" data-rel="tooltip" title="{{__('Add to Cart')}}"></i>
                <span class="add-to-cart-text">{{__('Add to Cart')}}</span>
            </a>
        @endif
    </td>

</tr>
