@if($row->stock_status == 'in')
    <div class="bc-product_shopping">
        <figure class="mb-0">
            <figcaption class="fs-14">{{ __('Quantity') }}</figcaption>
            <div class="form-group-number">
                <button class="up"><i class="fa fa-plus"></i></button>
                <button class="down"><i class="fa fa-minus"></i></button>
                <input class="form-control" name="quantity" type="number" min="1" max="{{ $row->is_manage_stock > 0 ? $row->quantity - $row->sold : 100 }}" value="1">
            </div>
        </figure>
        <a class="btn btn-black btn-add-to-cart" href="#">{{ __('Add to cart') }}</a>
        <a class="btn btn-buy-now" href="#">{{ __('Buy Now') }}</a>
        <div class="bc-product_actions">
            <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                <i class="fa fa-heart"></i>
            </div>
        </div>
    </div>
@endif
