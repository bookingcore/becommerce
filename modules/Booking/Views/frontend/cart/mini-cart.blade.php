<?php use Gloudemans\Shoppingcart\Facades\Cart; ?>
    @foreach(Cart::content() as $cartItem)
    <li class="list_content" style="animation-delay: 0.1s;">
        @if($cartItem->model)
        <a href="{{$cartItem->model->getDetailUrl()}}">            
            {!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'float-left'])!!}
            <p>{{$cartItem->model->title}}</p>
            <small>{{$cartItem->qty}} × {{format_money($cartItem->model->price)}}</small>
            <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
        </a>
        @else
        <a href="#">            
            <p>{{$cartItem->name}}</p>
            <small>{{$cartItem->qty}} × {{format_money($cartItem->price)}}</small>
            <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
        </a>
        @endif
    </li>
    @endforeach