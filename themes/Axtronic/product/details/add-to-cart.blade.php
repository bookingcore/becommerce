
    <div class="axtronic-product_shopping mb-4 pb-4 d-flex">
        <form class="axtronic_form_add_to_cart d-flex flex-column" action="{{route('cart.addToCart')}}">

            <div class="axtronic-form-variable">
                @csrf
                @if($row->product_type == 'variable')
                    @include('product.details.variations')
                @endif
                <input type="hidden" name="object_model" value="product">
                <input type="hidden" name="object_id" value="{{$row->id}}">
            </div>
            <div class="axtronic-form-add-cart d-flex flex-row">
                @if($row->product_type == 'variable' or ( $row->product_type == 'simple' and $row->stock_status == 'in' ))
                    <figure class="mb-0">
                        <div class="form-group-number cart-item-qty">
                            @php($max = $row->is_manage_stock > 0 ? $row->quantity : false)
                            <button class="down"><i class="fa fa-minus"></i></button>
                            <input class="form-control" name="quantity" type="number" min="1" @if($max ) max="{{ $max }}" @endif value="1">
                            <button class="up"><i class="fa fa-plus"></i></button>
                        </div>
                    </figure>
                    <button type="submit" class="btn btn-add-to-cart bc_add_to_cart">
                        {{ __('Add to cart') }}
                    </button>
                @endif
                @if($row->product_type == 'external')
                    <button type="button" class="btn btn-add-to-cart" onclick="window.location='{{ $row->external_url }}'">

                        {{ (!empty($row->button_text) )? $row->button_text : 'Buy now' }}
                    </button>
                @endif
                <button class="service-wishlist btn {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                    <i class="axtronic-icon-heart"></i>
                </button>
            </div>


        </form>
        {{--<button class="service-compare btn" data-id="{{$row->id}}">--}}
            {{--<i class="axtronic-icon-sync"></i>--}}
        {{--</button>--}}

    </div>

