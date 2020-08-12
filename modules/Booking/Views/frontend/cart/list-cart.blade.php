@php $stt = 0; @endphp
@foreach(Cart::content() as $cartItem)
    <tr class="cart-item">
        @if($cartItem->model)
            <td>
                <div class="ps-product--cart">
                    <div class="ps-product__thumbnail">
                        <a href="{{$cartItem->model->getDetailUrl()}}">
                            {!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'float-left img-120','lazy'=>false]) !!}
                        </a>
                    </div>
                    <div class="ps-product__content">
                        <a href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->name}}</a>
                        @if($author = $cartItem->model->author)
                            <p>{{__('Sold by:')}} <span>{{$author->getDisplayName()}}</span></p>
                        @endif
                    </div>
                </div>
            </td>

        @endif
        <td class="price" data-price="{{$cartItem->price}}" data-table="{{ __('Price:') }}"><span>{{format_money($cartItem->price)}}</span></td>
        <td class="quantity_box">
            <div class="form-group--number quantity-number">
                <button class="up">+</button>
                <button class="down">-</button>
                @php $stock_total = (!empty($cartItem->model->is_manage_stock)) ? $cartItem->model->quantity : null; @endphp
                <input class="form-control" type="number" name="product[{{$stt}}][{{$cartItem->rowId}}]" data-stock="{{$stock_total}}" inputmode="numeric" min="0" value="{{ $cartItem->qty }}">
            </div>
        </td>
        <td class="total" data-table="{{ __('Total:') }}"><span>{{ format_money($cartItem->qty * $cartItem->price) }}</span></td>
        <td class="remove_cart"><a href="#" class="bravo_delete_cart_item" data-id="{{$cartItem->rowId}}"><i class="icon-cross2"></i></a></td>
    </tr>
    @php $stt++; @endphp
@endforeach
