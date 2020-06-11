@if(Cart::count())
    <div class="cart__items">
        @foreach(Cart::content() as $cartItem)
            <div class="ps-product--cart-mobile">
                <div class="ps-product__thumbnail"><a href="{{$cartItem->model->getDetailUrl()}}">
                        {!! get_image_tag($cartItem->model->image_id,'thumb')!!}</a></div>
                <div class="ps-product__content"><a class="ps-product__remove bravo_cart_delete_ajax" data-id="{{$cartItem->id}}" href="#"><i class="icon-cross"></i></a><a href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->model->title}}</a>
                    <p>
                        @if($author = $cartItem->model->author)
                        <strong>{{__('Sold by')}}:</strong> {{$author->getDisplayName()}}</p>
                        @endif
                        <small>{{$cartItem->qty}} x {{format_money($cartItem->price)}}</small>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart__footer">
        <h3>{{__('Sub Total')}}:<strong>{{format_money(Cart::subtotal())}}</strong></h3>
        <figure>
            <a class="btn btn-primary view_cat" href="{{route('booking.cart')}}">{{__('View Cart')}}</a>
            <a class="btn btn-primary checkout" href="{{route('booking.checkout')}}">{{__('Checkout')}}</a>
        </figure>
    </div>
@else
        <div class="cart__items">
            <div>{{__("Your cart is empty")}}</div>
        </div>
@endif

