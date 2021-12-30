@extends("layouts.app")
@section('content')
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="index.html">{{__('Hoe')}}</a></li>
                    <li><a href="{{route('product.index')}}">{{__('Shop')}}</a></li>
                    <li>{{$page_title}}</li>
                </ul>
            </div>
        </div>
        <div class="ps-section--shopping ps-shopping-cart">
            @if(\Modules\Order\Helpers\CartManager::count())
                <div class="container">
                    <div class="ps-section__header">
                        <h1>{{__('Shopping Cart')}}</h1>
                    </div>
                    <div class="ps-section__content">
                        <form action="{{route('cart.update_cart_item')}}"method="post">
                            @csrf
                        <div class="table-responsive">
                            <table class="table ps-table--shopping-cart ps-table--responsive">
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
                                            <div class="ps-product--cart">
                                                @if($cartItem->model)
                                                    <div class="ps-product__thumbnail">
                                                        @if($cartItem->model->image_id)
                                                            <a href="{{$cartItem->getDetailUrl()}}"> {!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>''])!!}</a>
                                                        @endif
                                                    </div>
                                                    <div class="ps-product__content"><a
                                                            href="{{$cartItem->getDetailUrl()}}">{{$cartItem->name}}</a>
                                                        @if(!empty($cartItem->author))
                                                            <p>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="ps-product__thumbnail"></div>
                                                    <div class="ps-product__content">{{$cartItem->name}}</p>
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
                        <div class="ps-section__cart-actions"><a class="ps-btn" href="{{route('product.index')}}"><i
                                    class="icon-arrow-left"></i> {{__('Back to Shop')}}</a>
                            <button class="ps-btn ps-btn--outline" href=""><i class="icon-sync"></i> {{__('Update cart')}} </button>
                        </div>
                        </form>
                    </div>
                    <div class="ps-section__footer">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <figure>
                                    <figcaption>{{__('Coupon Discount')}}</figcaption>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <button class="ps-btn ps-btn--outline">{{__('Apply')}}</button>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <figure>
                                    <figcaption>{{__('Calculate shipping')}}</figcaption>
                                    <div class="form-group">
                                        <select class="ps-select">
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
                                        <button class="ps-btn ps-btn--outline">{{__('Update')}}</button>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block--shopping-total">
                                    <div class="ps-block__header">
                                        <p>{{__('Subtotal')}} <span> $683.49</span></p>
                                    </div>
                                    <div class="ps-block__content">
                                        <ul class="ps-block__product">
                                            <li><span class="ps-block__shop">YOUNG SHOP Shipping</span><span
                                                    class="ps-block__shipping">Free Shipping</span><span
                                                    class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a
                                                        href="#"> MVMTH Classical Leather Watch In Black ×1</a></span>
                                            </li>
                                            <li><span class="ps-block__shop">ROBERT’S STORE Shipping</span><span
                                                    class="ps-block__shipping">Free Shipping</span><span
                                                    class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a
                                                        href="#">Apple Macbook Retina Display 12” ×1</a></span></li>
                                        </ul>
                                        <h3>Total <span>$683.49</span></h3>
                                    </div>
                                </div>
                                <a class="ps-btn ps-btn--fullwidth" href="{{route('checkout')}}">{{__('Proceed to checkout')}}</a>
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
    <script>
        $(document).on('click','.cart-item-qty .up',function (e) {
            e.preventDefault()
            let me = $(this)
            let parent = me.closest('.cart-item-qty');
            let input = parent.find('input[type=number]')
            let value = input.val();
            const min = input.data('min');
            const max = input.data('max');
            value = value++;
            if(value <= min){
                value = min;
            }
            if(value => max){
                value = max;
            }
            input.val(value);
        })

        $(document).on('click','.cart-item-qty .down',function (e) {
            e.preventDefault()
            let me = $(this)
            let parent = me.closest('.cart-item-qty');
            let input = parent.find('input[type=number]')
            let value = input.val();
            const min = input.data('min',1);
            const max = input.data('max',1);
            value = --value;
            if(value <= min){
                value = min;
            }
            if(value => max){
                value = max;
            }
            input.val(value);
        })
    </script>
@endsection
