
    <div class="demus-product_shopping mb-4 pb-4 d-flex">
        <form class="bc_form_add_to_cart d-flex flex-column" action="{{route('cart.addToCart')}}">
            @csrf
            <input type="hidden" name="object_model" value="product">
            <input type="hidden" name="object_id" value="{{$row->id}}">

            @if($row->product_type == 'variable')
                <div class="demus-form-variable">
                    @include('product.details.variations')
                </div>
            @endif
            <div class="demus-form-add-cart ">
                <div class="d-flex flex-row">
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
                        <span>{{ __('Add to cart') }}</span>
                    </button>
                @endif

                @if($row->product_type == 'external')
                    <button type="button" class="btn btn-add-to-cart" onclick="window.location='{{ $row->external_url }}'">
                        <span>{{ (!empty($row->button_text) )? $row->button_text : 'Buy now' }}</span>
                    </button>
                @endif
                </div>
                @if($row->product_type == 'grouped')
                    <div class="demus-form-grouped w-100 mb-3">
                        <div class="card w-100">
                            <input type="hidden" name="quantity" value="1">
                            <ul class="list-group list-group-flush">
                                @foreach($row->children as $child_product)
                                    @php($max = $child_product->is_manage_stock > 0 ? $child_product->quantity : false)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{$child_product->title}}
                                        @switch($child_product->product_type)
                                            @case('simple')
                                            <div class="cart_btn">
                                                <div class="form-group-number cart-item-qty">
                                                    <button class="down"><i class="fa fa-minus"></i></button>
                                                    <input class="form-control" type="number" name="children[{{$child_product->id}}]" min="1" @if($max ) max="{{ $max }}" @endif value="1"/>
                                                    <button class="up"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            @break
                                            @case('variable')
                                            <div>
                                                <a href="{{$child_product->getDetailUrl()}}" class="btn btn-primary d-flex align-items-center justify-content-center">{{__("Select variation")}}</a>
                                            </div>
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
                    </div>
                    <button type="submit" class="btn btn-add-to-cart bc_add_to_cart ">
                        <span>{{ __('Add to cart') }}</span>
                    </button>
                @endif
                {{--<button class="service-wishlist btn {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">--}}
                    {{--<i class="axtronic-icon-heart"></i>--}}
                {{--</button>--}}
            </div>
        </form>
        {{--<button class="service-compare btn" data-id="{{$row->id}}">--}}
            {{--<i class="demus-icon-sync"></i>--}}
        {{--</button>--}}

    </div>

