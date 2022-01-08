@extends("layouts.app")
@section('content')
    <div class="bc-page--simple">
        <div class="bc-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{home_url()}}">{{__('Home')}}</a></li>
                    <li><a href="{{route('product.index')}}">{{__('Shop')}}</a></li>
                    <li>{{$page_title}}</li>
                </ul>
            </div>
        </div>
        <div class="bc-section--shopping bc-shopping-cart">
            @if(\Modules\Order\Helpers\CartManager::count())
                <div class="container">
                    <div class="bc-section__header">
                        <h1>{{__('Shopping Cart')}}</h1>
                    </div>
                    <div class="bc-section__content">
                        <form action="{{route('cart.update_cart_item')}}"method="post">
                            @csrf
                        <div class="table-responsive">
                            <table class="table bc-table--shopping-cart bc-table--responsive">
                                <thead>
                                <tr>
                                    <th>{{__('Product name')}}</th>
                                    <th>{{__('PRICE')}}</th>
                                    <th>{{__('QUANTITY')}}</th>
                                    <th>{{__('TOTAL')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\Modules\Order\Helpers\CartManager::items() as $cartItem)
                                    <tr>
                                        <td data-label="Product">
                                            <div class="bc-product--cart">
                                                @if($cartItem->model)
                                                    <div class="bc-product__thumbnail">
                                                        @if($cartItem->model->image_id)
                                                            <a href="{{$cartItem->getDetailUrl()}}"> {!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>''])!!}</a>
                                                        @endif
                                                    </div>
                                                    <div class="bc-product__content"><a
                                                            href="{{$cartItem->getDetailUrl()}}">{{$cartItem->name}}</a>
                                                        @if(!empty($cartItem->author))
                                                            <p>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="bc-product__thumbnail"></div>
                                                    <div class="bc-product__content">{{$cartItem->name}}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="price" data-label="Price">{{format_money($cartItem->price)}}</td>
                                        <td data-label="Quantity">
                                            <div class="form-group--number cart-item-qty">
                                                <button class="up">+</button>
                                                <button class="down">-</button>
                                                <input name="cart_item[{{$cartItem->id}}][qty]" class="form-control" type="number"
                                                       placeholder="{{$cartItem->qty}}"
                                                       value="{{$cartItem->qty}}">
                                            </div>
                                        </td>
                                        <td data-label="Total">{{format_money($cartItem->subtotal)}}</td>
                                        <td data-label="Actions">
                                            <a href="#" class="bc_delete_cart_item" data-id="{{$cartItem->id}}" data-remove="tr">
                                                <i class="icon-cross"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="bc-section__cart-actions"><a class="btn" href="{{route('product.index')}}"><i
                                    class="icon-arrow-left"></i> {{__('Back to Shop')}}</a>
                            <button class="btn btn--outline" href=""><i class="icon-sync"></i> {{__('Update cart')}} </button>
                        </div>
                        </form>
                    </div>
                    <div class="bc-section__footer">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <figure class="section-coupon-form">
                                    <figcaption>{{__('Coupon Discount')}}</figcaption>
                                    <div class="form-group">
                                        <input name="coupon_code" class="form-control" type="text" placeholder="" value="">
                                    </div>
                                    <div class="message alert-text mt-2"></div>
                                    <div class="form-group">
                                        <button class="btn btn--outline bc_apply_coupon">{{__('Apply')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
                                    </div>
                                    @if(!empty($coupons = \Modules\Order\Helpers\CartManager::getCoupon()))
                                        <h4>{{__("List Coupon")}}</h4>
                                        <ul class="p-0 mb-3 list-coupons list-disc">
                                            @foreach($coupons as $coupon)
                                                <li class="item d-flex justify-content-between">
                                                    <div class="label">
                                                        {{ $coupon->code }}
                                                        <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $coupon->name}}"></i>
                                                    </div>
                                                    <div class="val">
                                                            <a href="#" data-code="{{ $coupon->code }}" class="text-danger text-decoration-none bc_remove_coupon"> {{ __("[Remove]") }}
                                                                <i class="fa fa-spin fa-spinner d-none"></i>
                                                            </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </figure>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <figure>
                                    <figcaption>{{__('Calculate shipping')}}</figcaption>
                                    <div class="form-group">
                                        <select class="bc-select">
                                            <option value="1">America</option>
                                            <option value="2">Italia</option>
                                            <option value="3">Vietnam</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Town/City">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Postcode/Zip">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn--outline">{{__('Update')}}</button>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <div class="bc-block--shopping-total">
                                    <div class="bc-block__header">
                                        <p>{{__('Subtotal')}} <span>{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span></p>
                                    </div>
                                    <div class="bc-block__content">
                                        <ul class="bc-block__product">
                                            <li><span class="bc-block__shop">YOUNG SHOP Shipping</span><span
                                                    class="bc-block__shipping">Free Shipping</span><span
                                                    class="bc-block__estimate">Estimate for <strong>Viet Nam</strong><a
                                                        href="#"> MVMTH Classical Leather Watch In Black ×1</a></span>
                                            </li>
                                            <li><span class="bc-block__shop">ROBERT’S STORE Shipping</span><span
                                                    class="bc-block__shipping">Free Shipping</span><span
                                                    class="bc-block__estimate">Estimate for <strong>Viet Nam</strong><a
                                                        href="#">Apple Macbook Retina Display 12” ×1</a></span></li>
                                        </ul>
                                        <h3>{{__('Total')}} <span>{{format_money(\Modules\Order\Helpers\CartManager::total())}}</span></h3>
                                    </div>
                                </div>
                                <a class="btn btn--fullwidth" href="{{route('checkout')}}">{{__('Proceed to checkout')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">{{__("Your cart is empty!")}}</div>
            @endif
        </div>
    </div>

@endsection
@section('footer')
    <script src="{{theme_url('base/order/cart.js')}}"></script>
@endsection
