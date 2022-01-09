<?php
$countCart = \Modules\Order\Helpers\CartManager::count();
?>
<a class="header__extra" href="#"><i class="fa fa-shopping-bag"></i><span><i class="cart-count">{{$countCart}}</i></span></a>
<div class="bc-cart__content">
    @if(!empty($countCart))
    <div class="bc-cart__items">
            @foreach(\Modules\Order\Helpers\CartManager::items() as $cart_item_id => $cartItem)
                <div class="bc-product--cart-mobile">
                    @if($cartItem->model)
                    <div class="bc-product__thumbnail">
                        <a href="{{$cartItem->model->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'img-fluid w-75px','lazy'=>false])!!} </a></div>
                    <div class="bc-product__content">
                        <a class="bc-product__remove bc_delete_cart_item" data-id="{{$cartItem->id}}" href="#"><i class="icon-cross"></i></a>
                        <a href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->model->title}}</a>
                        @if(!empty($cartItem->author))
                            <p>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></p>
                        @endif
                        <small>
                            {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                    </div>
                    @else
                        <div class="bc-product__thumbnail">
                            <a href="#"><img src="" alt=""></a></div>
                        <div class="bc-product__content">
                            <a class="bc-product__remove bc_delete_cart_item" data-id="{{$cartItem->id}}" href="#"><i class="icon-cross"></i></a>
                            <a href="#">{{$cartItem->name}}</a>
                            @if(!empty($cartItem->author))
                                <p>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></p>
                            @endif
                            <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                        </div>
                    @endif
                </div>
            @endforeach
    </div>
    <div class="bc-cart__footer">
        <h3> {{__('Subtotal')}} : <strong>{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</strong> </h3>
        <figure><a class="btn" href="{{route('cart')}}">{{__('View Cart')}}</a> <a class="btn" href="{{route('checkout')}}">{{__("Checkout")}}</a></figure>
    </div>
    @else
        <div class="bc-cart__items border-bottom">
            <p class="text-center font-weight-bold">{{__("Your cart is empty")}}</p>
        </div>
    @endif
</div>
