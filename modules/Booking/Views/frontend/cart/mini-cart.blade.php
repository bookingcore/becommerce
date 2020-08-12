@if(Cart::count())
    <div class="cart__items">
        @foreach(Cart::content() as $cartItem)
            <div class="ps-product--cart-mobile">
                <div class="ps-product__thumbnail">
                    <a href="{{$cartItem->model->getDetailUrl()}}">
                        {!! get_image_tag($cartItem->model->image_id,'thumb',['lazy'=>false]) !!}
                    </a>
                </div>
                <div class="ps-product__content">
                    <a class="ps-product__remove bravo_delete_cart_item" data-id="{{$cartItem->rowId}}" href="#">
                        <i class="icon-cross"></i>
                    </a>
                    <a href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->name}}</a>
                @if($cartItem->options->has('size'))
                    <p><strong>{{__('Size')}}:</strong> {{$cartItem->options->size}}</p>
                @endif
                @if($author = $cartItem->model->author)
                    <p><strong>{{__('Sold by')}}:</strong> {{$author->getDisplayName()}}</p>
                @endif
                    <small>{{$cartItem->qty}} x {{format_money($cartItem->price)}}</small>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart__footer">
        <h3>{{__('Subtotal')}}:<strong>{{format_money(Cart::subtotal())}}</strong></h3>
        <figure>
            <a class="btn btn-primary view_cat" href="{{route('booking.cart')}}">{{__('View Cart')}}</a>
            <a class="btn btn-primary checkout" href="{{route('booking.checkout')}}">{{__('Checkout')}}</a>
        </figure>
    </div>
@else
        <div class="cart__items">
            <div class="cart__empty">{{__("Your cart is empty")}}</div>
        </div>
@endif

