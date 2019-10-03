@extends('Layout::app')

@section('content')
    @include('Layout::parts.bc')

    <div class="bravo-cart-page bravo-page-content">
        <div class="container">
            <h1 class="entry-title">{{__('Shopping Cart')}}</h1>

            <div class="bravo-content">
                @include('Layout::admin.message')
                <div class="cart-table-wrap">
                    <div class="table-responsive">
                        <table class="cart-table shop-table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">{{__('Product')}}</th>
                                    <th class="product-price">{{__('Price')}}</th>
                                    <th class="product-quantity">{{__('Quantity')}}</th>
                                    <th class="product-subtotal">{{__('Total')}}</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Cart::itemCount())
                                    @foreach(Cart::getItems() as $item)
                                        <td class="product-thumbnail">
                                            @if($item->product->image_id)
                                                {!! get_image_tag($item->product->image_id) !!}
                                            @endif
                                        </td>
                                        <td class="product-name">
                                            <a class="product-name-tag" href="{{route('product.detail',['slug'=>$item->product->slug])}}">{{$item->product->title}}</a>
                                            <span class="sold-by">{{__('Sold By:')}} <a href="{{route('user.profile',['id'=>$item->product->create_user])}}" target="_blank">{{$item->product->author->getDisplayName()}}</a></span>
                                        </td>
                                        <td class="product-price">
                                            {{$item->price_html}}
                                        </td>
                                        <td class="product-quantity">
                                        {{$item->quantity}}
                                        </td>
                                        <td class="product-subtotal">
                                            {{format_money($item->total)}}
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{route('cart.remove',['id'=>$item->id])}}" class="mf-remove" aria-label="{{__('Remove this item')}}" data-product_id="{{$item->product_id}}" ><i class="icon-cross2"></i></a>
                                        </td>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-actions d-flex justify-content-between">
                        <div class="">
                            <a href="{{route('product.index')}}" class="btn btn-primary"><i class="icon-arrow-left"></i> {{__("Back To Shop")}}</a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-light"> {{__("Clear cart")}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">@include('Cart::frontend.cart.coupon')</div>
                        <div class="col-md-4">@include('Cart::frontend.cart.sub-total')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection