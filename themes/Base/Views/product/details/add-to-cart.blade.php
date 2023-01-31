<form class="bc_form_add_to_cart" action="{{route('cart.addToCart')}}">
    @csrf
    @if($row->product_type == 'variable')
        @include('product.details.variations')
    @endif
    <input type="hidden" name="object_model" value="product">
    <input type="hidden" name="object_id" value="{{$row->id}}">
    <div class="bc-product_shopping mb-4 pb-4">
        @if($row->product_type == 'variable' or ( $row->product_type == 'simple' and $row->stock_status == 'in' ))
            <div class=" d-flex">
                <figure class="mb-0">
                    <figcaption class="fs-14 mb-1">{{ __('Quantity') }}</figcaption>
                    <div class="form-group-number cart-item-qty">
                        @php($max = $row->is_manage_stock > 0 ? $row->quantity : false)
                        <button class="up"><i class="fa fa-plus"></i></button>
                        <button class="down"><i class="fa fa-minus"></i></button>
                        <input class="form-control" name="quantity" type="number" min="1" @if($max ) max="{{ $max }}" @endif value="1">
                    </div>
                </figure>
                <button type="submit" class="btn btn-outline-primary btn-add-to-cart bc_add_to_cart">
                    <i class="fa fa-spinner d-none"></i>{{ __('Add to cart') }}
                </button>
            </div>
        @endif
        @if($row->product_type == 'external')
            <a href="{{ $row->external_url }}" rel="nofollow" class="btn btn-outline-primary">
                {{ $row->button_text }}
            </a>
        @endif
        @if($row->product_type == 'grouped')
                <input type="hidden" name="quantity" value="1">
            <div class="card w-100">
                <ul class="list-group list-group-flush">
                    @foreach($row->children as $child_product)
                    <li class="list-group-item d-flex justify-content-between">
                        {{$child_product->title}}
                        @switch($child_product->product_type)
                            @case('simple')
                            <figure class="mb-0">
                                <div class="form-group-number cart-item-qty">
                                    @php($max = $child_product->is_manage_stock > 0 ? $child_product->quantity : false)
                                    <button class="up"><i class="fa fa-plus"></i></button>
                                    <button class="down"><i class="fa fa-minus"></i></button>
                                    <input class="form-control" name="children[{{$child_product->id}}]" type="number" min="1" @if($max ) max="{{ $max }}" @endif value="1">
                                </div>
                            </figure>
                            @break
                            @case('variable')
                                <a href="{{$child_product->getDetailUrl()}}" class="btn btn-primary">{{__("Select variation")}}</a>
                            @break
                            @case('external')
                                <a href="{{ $child_product->external_url }}" rel="nofollow" class="btn btn-outline-primary">
                                    {{ $child_product->button_text }}
                                </a>
                            @break
                        @endswitch
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-100 mt-3">
                <button type="submit" class="btn btn-outline-primary btn-add-to-cart bc_add_to_cart">
                    <i class="fa fa-spinner d-none"></i>{{ __('Add to cart') }}
                </button>
            </div>
        @endif
        <div class="axtronic-product_actions">
            <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                <i class="fa fa-heart"></i>
            </div>
        </div>
    </div>
</form>
