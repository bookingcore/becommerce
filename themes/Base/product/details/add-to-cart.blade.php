@if($row->stock_status == 'in')
    <form class="bc_form_add_to_cart" action="{{route('cart.addToCart')}}">
        @csrf
        @if($row->product_type == 'variable')
            @include('product.details.variations')
        @endif
            <input type="hidden" name="object_model" value="product">
            <input type="hidden" name="object_id" value="{{$row->id}}">
            <div class="bc-product_shopping mb-4 pb-4 d-flex">
                @if($row->product_type != 'external')
                    <figure class="mb-0">
                        <figcaption class="fs-14 mb-1">{{ __('Quantity') }}</figcaption>
                        <div class="form-group-number cart-item-qty">
                            @php($max = $row->is_manage_stock > 0 ? $row->quantity : 100)
                            <button class="up"><i class="fa fa-plus"></i></button>
                            <button class="down"><i class="fa fa-minus"></i></button>
                            <input class="form-control" name="quantity" type="number" min="1" max="{{ $max }}" value="1">
                        </div>
                    </figure>
                    <button type="submit" class="btn btn-outline-primary btn-add-to-cart bc_add_to_cart">
                        <i class="fa fa-spinner d-none"></i>{{ __('Add to cart') }}
                    </button>
                @else
                    <a href="{{ $row->external_url }}" rel="nofollow" class="btn btn-outline-primary">
                        {{ $row->button_text }}
                    </a>
                @endif
                <div class="bc-product_actions">
                    <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                        <i class="fa fa-heart"></i>
                    </div>
                </div>
            </div>
    </form>
@endif
