<div class="cart_page_form">
    <form action="#">
        <table class="table table-responsive">
              <thead>
                <tr class="carttable_row">
                    <th class="cartm_title">{{__('Product')}}</th>
                    <th class="cartm_title">{{__('Price')}}</th>
                    <th class="cartm_title">{{__('Quantity')}}</th>
                    <th class="cartm_title">{{__('Total')}}</th>
                </tr>
              </thead>
              <tbody class="table_body">
                
                @foreach(Cart::content() as $cartItem)
                <tr>
                    <th scope="row">
                        @if($cartItem->model)
                            <ul class="cart_list d-flex align-center">
                                <li class="list-inline-item pr15"><a href="#" @click.prevent="deleteCartItem($cartItem)"><img src="{{asset('dist/frontend/module/course/images/shop/close.png')}}" alt="close.png"></a></li>
                                <li class="list-inline-item pr20">
                                    {!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'float-left img-120'])!!}
                                </li>
                                <li class="list-inline-item"><a class="cart_title" href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->name}}</li>
                            </ul>                        
                        @else     
                            <ul class="cart_list d-flex align-center">
                                <li class="list-inline-item pr15"><a href="#"><img src="{{asset('dist/frontend/module/course/images/shop/close.png')}}" alt="close.png"></a></li>
                                <li class="list-inline-item pr20">
                                </li>
                                <li class="list-inline-item"><a class="cart_title" >{{$cartItem->name}}</li>
                            </ul>                 
                        @endif
                    </th>
                    <td>{{format_money($cartItem->price)}}</td>
                    <td>1</td>
                    <td class="cart_total">{{format_money($cartItem->total)}}</td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </form>
</div>
<div class="checkout_form">
    <div class="checkout_coupon ui_kit_button">
        <form class="form-inline">
            <input class="form-control" type="text" v-model="coupon" placeholder="{{__('Coupon Code')}}" aria-label="Search">
            <button type="button" @click="applyCoupon" class="btn btn2">{{__('Apply Coupon')}}</button>
            <button type="button" @click="updateCart" class="btn btn3">{{__('Update Cart')}}</button>
        </form>
    </div>
</div>