<div class="cart_page_form">
    <h1>Tien pham</h1>
    <form action="#">
        <div class="table-responsive">
        <table class="table ">
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
        </div>
    </form>
</div>
<div class="checkout_form">
    <div class="checkout_coupon ui_kit_button">
        <form class="form-inline">
            <input class="form-control" type="text" v-model="coupon" placeholder="{{__('Coupon Code')}}" aria-label="Search">
            <button type="button" @click="applyCoupon" class="btn btn-sm btn-primary">{{__('Apply Coupon')}}</button>
            <button type="button" @click="updateCart" class="btn btn-sm btn-primary">{{__('Update Cart')}}</button>
        </form>
    </div>
</div>

<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__header">
           <h1>Shopping Cart</h1>
        </div>
        <div class="ps-section__content">
           <div class="table-responsive">
              <table class="table ps-table--shopping-cart">
                 <thead>
                    <tr>
                       <th>Product name</th>
                       <th>PRICE</th>
                       <th>QUANTITY</th>
                       <th>TOTAL</th>
                       <th></th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                       <td>
                          <div class="ps-product--cart">
                             <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/1.jpg" alt="" data-insta_upload_ext_elem="1"></a></div>
                             <div class="ps-product__content">
                                <a href="product-default.html">Marshall Kilburn Wireless Bluetooth Speaker, Black (A4819189)</a>
                                <p>Sold By:<strong> YOUNG SHOP</strong></p>
                             </div>
                          </div>
                       </td>
                       <td class="price">$205.00</td>
                       <td>
                          <div class="form-group--number">
                             <button class="up">+</button>
                             <button class="down">-</button>
                             <input class="form-control" type="text" placeholder="1" value="1">
                          </div>
                       </td>
                       <td>$205.00</td>
                       <td><a href="#"><i class="icon-cross"></i></a></td>
                    </tr>
                    <tr>
                       <td>
                          <div class="ps-product--cart">
                             <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/clothing/2.jpg" alt="" data-insta_upload_ext_elem="1"></a></div>
                             <div class="ps-product__content">
                                <a href="product-default.html">Unero Military Classical Backpack</a>
                                <p>Sold By:<strong> YOUNG SHOP</strong></p>
                             </div>
                          </div>
                       </td>
                       <td class="price">$205.00</td>
                       <td>
                          <div class="form-group--number">
                             <button class="up">+</button>
                             <button class="down">-</button>
                             <input class="form-control" type="text" placeholder="1" value="1">
                          </div>
                       </td>
                       <td>$205.00</td>
                       <td><a href="#"><i class="icon-cross"></i></a></td>
                    </tr>
                 </tbody>
              </table>
           </div>
           <div class="ps-section__cart-actions"><a class="ps-btn" href="shop-default.html"><i class="icon-arrow-left"></i> Back to Shop</a><a class="ps-btn ps-btn--outline" href="shop-default.html"><i class="icon-sync"></i> Update cart</a></div>
        </div>
        <div class="ps-section__footer">
           <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                 <figure>
                    <figcaption>Coupon Discount</figcaption>
                    <div class="form-group">
                       <input class="form-control" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                       <button class="ps-btn ps-btn--outline">Apply</button>
                    </div>
                 </figure>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                 <figure>
                    <figcaption>Calculate shipping</figcaption>
                    <div class="form-group">
                       <select class="ps-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          <option value="1" data-select2-id="3">America</option>
                          <option value="2">Italia</option>
                          <option value="3">Vietnam</option>
                       </select>
                       <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 120px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-wuzc-container"><span class="select2-selection__rendered" id="select2-wuzc-container" role="textbox" aria-readonly="true" title="America">America</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>
                    <div class="form-group">
                       <input class="form-control" type="text" placeholder="Town/City">
                    </div>
                    <div class="form-group">
                       <input class="form-control" type="text" placeholder="Postcode/Zip">
                    </div>
                    <div class="form-group">
                       <button class="ps-btn ps-btn--outline">Update</button>
                    </div>
                 </figure>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                 <div class="ps-block--shopping-total">
                    <div class="ps-block__header">
                       <p>Subtotal <span> $683.49</span></p>
                    </div>
                    <div class="ps-block__content">
                       <ul class="ps-block__product">
                          <li><span class="ps-block__shop">YOUNG SHOP Shipping</span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#"> MVMTH Classical Leather Watch In Black ×1</a></span></li>
                          <li><span class="ps-block__shop">ROBERT’S STORE Shipping</span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#">Apple Macbook Retina Display 12” ×1</a></span></li>
                       </ul>
                       <h3>Total <span>$683.49</span></h3>
                    </div>
                 </div>
                 <a class="ps-btn ps-btn--fullwidth" href="checkout.html">Proceed to checkout</a>
              </div>
           </div>
        </div>
     </div>
</div>
