<form class="bc_form_add_to_cart" action="{{route('cart.addToCart')}}">
    @include('product.details.campaign')
    @csrf
    <input type="hidden" name="object_model" value="product">
    <input type="hidden" name="object_id" value="{{$row->id}}">
    <ul class="cart_btns ui_kit_button">
        @if($row->product_type == 'variable')
            @include('product.details.variations')
        @endif
        @if($row->product_type == 'variable' or ( $row->product_type == 'simple' and $row->stock_status == 'in' ))
            @php($max = $row->is_manage_stock > 0 ? $row->quantity : false)
            <li class="list-inline-item mb30">
                <div class="cart_btn">
                    <div class="quantity-block">
                        <button type="button" class="quantity-arrow-minus inner_page down"> -</button>
                        <input class="quantity-num inner_page" type="number" name="quantity" min="1" @if($max ) max="{{ $max }}" @endif value="1"/>
                        <button type="button" class="quantity-arrow-plus inner_page up"> +</button>
                    </div>
                </div>
            </li>
            <li class="list-inline-item mb30">
                <button type="submit" class="btn btn-thm bc_add_to_cart btn-add-to-cart">
                    <span class="flaticon-shopping-cart mr5 fz18 vam"></span> {{ __('Add to cart') }} <i class="fa fa-spinner d-none"></i>
                </button>
            </li>
        @endif
        @if($row->product_type == 'grouped')
            <li class="d-block mb30">
            <div class="card w-100">
                <input type="hidden" name="quantity" value="1">
                <ul class="list-group list-group-flush">
                    @foreach($row->children as $child_product)
                        @php($max = $child_product->is_manage_stock > 0 ? $child_product->quantity : false)
                        <li class="list-group-item d-flex justify-content-between">
                            {{$child_product->title}}
                            @switch($child_product->product_type)
                                @case('simple')
                                    <div class="cart_btn">
                                        <div class="quantity-block">
                                            <button type="button" class="quantity-arrow-minus inner_page down"> -</button>
                                            <input class="quantity-num inner_page" type="number" name="children[{{$child_product->id}}]" min="1" @if($max ) max="{{ $max }}" @endif value="1"/>
                                            <button type="button" class="quantity-arrow-plus inner_page up"> +</button>
                                        </div>
                                    </div>
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
            </li>
            <li class="d-block mb30">
                <button type="submit" class="btn btn-thm bc_add_to_cart btn-add-to-cart">
                    <span class="flaticon-shopping-cart mr5 fz18 vam"></span> {{ __('Add to cart') }} <i class="fa fa-spinner d-none"></i>
                </button>
            </li>
        @endif
        @if($row->product_type == 'external')
            <li class="list-inline-item">
                <button type="button" class="btn btn-thm" onclick="window.location='{{ $row->external_url }}'">
                    <span class="flaticon-shopping-cart mr5 fz18 vam"></span>
                    {{ $row->button_text }}
                </button>
            </li>
        @endif
    </ul>
</form>
