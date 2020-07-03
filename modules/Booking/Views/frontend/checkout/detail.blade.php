<h3 id="order_review_heading">{{ __('Your order') }}</h3>
<div id="order_review" class="bravo-checkout-review-order">
    <table class="shop_table bravo-checkout-review-order-table">
        <thead>
            <tr>
                <th class="product-name">{{ __('Product') }}</th>
                <th class="product-total">{{ __('Subtotal') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(Cart::count())
                @foreach(Cart::content() as $cartItem)
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $cartItem->name }} <span class="product-quantity">× {{$cartItem->qty}}</span>
                            <dl class="variation">
                                <dt class="variation-SoldBy">{{ __('Sold By:') }}</dt>
                                <dd class="variation-SoldBy"><p>{{ mb_strtoupper($cartItem->model->author->getDisplayName()) }}</p>
                                </dd>
                            </dl>
                        </td>
                        <td class="product-total">
                            <span class="bravo-Price-amount amount">{{ format_money($cartItem->price) }}</span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr class="cart-subtotal">
                <th>{{ __('Subtotal') }}</th>
                <td>
                    <span class="bravo-Price-amount amount">
                        {{ format_money(Cart::subtotal()) }}
                    </span>
                </td>
            </tr>
            @if($coupons = session('coupon'))
                @foreach($coupons as $coupon)
                    <tr class="cart_coupon">
                        <td class="coupon_text text-left">{{ __('Coupon: :code',['code'=>$coupon['name']]) }}</td>
                        @php $discount = ($coupon['type'] == 'percent') ? Cart::subtotal() * $coupon['discount']/100 : $coupon['discount'] @endphp
                        <td class="coupon_discount text-right">-{{ format_money($discount) }}</td>
                    </tr>
                @endforeach
            @endif

            {{--<tr class="bravo-shipping-totals shipping">
                <td colspan="2" data-title="YOUNG SHOP Shipping">
                    <h4 class="shipping-title">YOUNG SHOP Shipping</h4>
                    <ul id="shipping_method" class="bravo-shipping-methods">
                        <li>
                            <input type="hidden" name="shipping_method[234]" data-index="234" id="shipping_method_234_free_shipping1" value="free_shipping:1" class="shipping_method"><label for="shipping_method_234_free_shipping1">Free shipping</label>					</li>
                    </ul>

                    <p class="bravo-shipping-contents"><small>Korea Long Sofa Fabric In Blue Navy Color ×1</small></p>			</td>
            </tr>
            <tr class="bravo-shipping-totals shipping">
            <td colspan="2" data-title="ROBERT’S STORE Shipping">
                <h4 class="shipping-title">ROBERT’S STORE Shipping</h4>
                <ul id="shipping_method" class="bravo-shipping-methods">
                    <li>
                        <input type="hidden" name="shipping_method[235]" data-index="235" id="shipping_method_235_free_shipping1" value="free_shipping:1" class="shipping_method"><label for="shipping_method_235_free_shipping1">Free shipping</label>					</li>
                </ul>

                <p class="bravo-shipping-contents"><small>LG White Front Load Steam Washer ×1, Set 30 Piece Korea StartSkin Natural Mask ×1</small></p>			</td>
        </tr>--}}

            <tr class="order-total">
                <th>{{ __('Total') }}</th>
                <td>
                    <strong class="bravo-Price-amount">{{format_money(Cart::final_total())}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>

    {{--<div id="payment" class="bravo-checkout-payment">
        <ul class="wc_payment_methods payment_methods methods">
            <li class="wc_payment_method payment_method_bacs">
                <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">

                <label for="payment_method_bacs">
                    Direct bank transfer 	</label>
                <div class="payment_box payment_method_bacs">
                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                </div>
            </li>
            <li class="wc_payment_method payment_method_cod">
                <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="">

                <label for="payment_method_cod">
                    Cash on delivery 	</label>
                <div class="payment_box payment_method_cod" style="display:none;">
                    <p>Pay with cash upon delivery.</p>
                </div>
            </li>
            <li class="wc_payment_method payment_method_paypal">
                <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">

                <label for="payment_method_paypal">
                    PayPal <img src="https://www.paypalobjects.com/webstatic/en_AU/mktg/logo/Solutions-graphics-1-184x80.jpg" alt="PayPal acceptance mark"><a href="https://www.paypal.com/au/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/au/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">What is PayPal?</a>	</label>
                <div class="payment_box payment_method_paypal" style="display:none;">
                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                </div>
            </li>
        </ul>
        <div class="form-row place-order">
            <noscript>
                Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.			<br/><button type="submit" class="button alt" name="bravo_checkout_update_totals" value="Update totals">Update totals</button>
            </noscript>

            <div class="bravo-terms-and-conditions-wrapper">
                <div class="bravo-privacy-policy-text"></div>
            </div>


            <button type="submit" class="button alt" name="bravo_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>

            <input type="hidden" id="bravo-process-checkout-nonce" name="bravo-process-checkout-nonce" value="06aa11fccd"><input type="hidden" name="_wp_http_referer" value="/martfury3/?wc-ajax=update_order_review">	</div>
    </div>--}}
</div>
