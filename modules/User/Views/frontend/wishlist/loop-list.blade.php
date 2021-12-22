<?php $row = (!empty($item)) ? $item->getService : ''; ?>
<tr>
    <td class="product-remove item_{{$row->id}}">
        <a href="{{route('user.wishList.remove')}}?id={{$row->id}}&type={{$row->type}}" class="remove remove_from_wishlist" title="Remove this product">×</a>
    </td>
    <td class="product-thumbnail">
        <a href="{{route('product.detail',['slug'=>$row->slug])}}">
            @if($row->image_url)
                <img src="{{$row->image_url}}" class="img-responsive" alt="{{$row->title}}">
            @endif
        </a>
    </td>
    <td class="product-name">
        <a href="{{route('product.detail',['slug'=>$row->slug])}}">{{$row->title}}</a>
    </td>
    <td class="product-price" data-table="{{ __('Price:') }}">
        @include('Product::frontend.details.price')
    </td>
    <td class="product-stock-status" data-table="{{ __('Stock:') }}">
        <span class="{{ ($row->stock_status == 'in') ? 'wishlist-in-stock' : 'wishlist-out-of-stock' }}">{{ ($row->stock_status == 'in') ? 'In Stock' : 'Out of stock' }}</span>
    </td>

    <td class="product-add-to-cart">
        @if($row->stock_status == 'in')
            @php $is_variable = $row->product_type == 'variable' @endphp
            <a href="{{ $is_variable ? $row->getDetailUrl() : '' }}" class="button {{ !$is_variable ? 'bc_add_to_cart' : null }}" data-product={"id":{{$row->id}},"type":"{{$row->product_type}}"}>
                <i class="p-icon icon-bag2" data-toggle="tooltip" title="{{ $is_variable ? __('Select options') : __('Add to Cart') }}"></i>
                <span class="add-to-cart-text">{{ $is_variable ? __('Select options') : __('Add to Cart') }}</span>
            </a>
        @endif
    </td>

</tr>
