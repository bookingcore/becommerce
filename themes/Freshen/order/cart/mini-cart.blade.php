<?php
$countCart = \Modules\Order\Helpers\CartManager::count();
?>
<div class="div">
    <a class="cart_btn" href="#">
        <span class="flaticon-shopping-cart icon">
            <span class="badge bgc-thm{{ setting_item('freshen_header_style') }}"> {{\Modules\Order\Helpers\CartManager::count()}} </span>
        </span>
    </a>
    <ul class="dropdown_content text-start bc-mini-cart-dropdown bc-cart-items">
        @if(!empty($countCart))
            @foreach(\Modules\Order\Helpers\CartManager::items() as $cart_item_id => $cartItem)
                <li class="list_content">
                    @if($cartItem->model)
                        <a href="{{$cartItem->getDetailUrl()}}">
                            {!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'float-start','lazy'=>false])!!}
                            <p>{{$cartItem->model->title}}</p>
                            @if(is_vendor_enable() and !empty($cartItem->author))
                                <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                            @endif
                            <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                            <span class="close_icon float-end bc_delete_cart_item" data-id="{{$cartItem->id}}">
                                <i class="fa fa-plus"></i>
                            </span>
                        </a>
                    @else
                        <li class="list_content">
                            <a href="#">
                                <img class="float-start" src="#" alt="50x50">
                                <p>{{$cartItem->name}}</p>
                                @if(!empty($cartItem->author))
                                    <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                                @endif
                                <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                <span class="close_icon float-end bc_delete_cart_item" data-id="{{$cartItem->id}}">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </li>
                    @endif
                </li>
            @endforeach
            <li class="list_content bc-cart-footer">
                <h5>Subtotal: <span class="text-thm fw400 float-end">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span></h5>
                <a href="{{route('cart')}}" class="btn btn-thm cart_btns">{{ __("VIEW CART") }}</a>
                <a href="{{route('checkout')}}" class="btn btn-thm2 checkout_btns">{{ __("CHECKOUT") }}</a>
            </li>
        @else
            <li class="pb-0">
                <div class="text-center font-weight-bold">{{__("Your cart is empty")}}</div>
            </li>
        @endif
    </ul>
</div>
