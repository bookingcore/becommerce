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

            <tr class="order-total">
                <th>{{ __('Total') }}</th>
                <td>
                    <strong class="bravo-Price-amount">{{format_money(Cart::final_total())}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
