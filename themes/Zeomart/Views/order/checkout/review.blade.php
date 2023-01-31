<div class="order-box rounded border border-gray-200 p-8 mb-3">
    <h4 class="title font-semibold mb-3 text-lg">{{__('Your Order')}}</h4>
    <table class="table w-full ">
        <thead class="text-left">
        <tr class="">
            <th><strong>{{__('Product')}}</strong></th>
            <th width="25%" class=""><strong>{{__('Quality')}}</strong></th>
            <th width="25%" class=""><strong>{{__('Subtotal')}}</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $cartItem)
        <tr class="cart-item">
            <td class="product-name py-3">
                {{$cartItem->title}}
                @if($variation = $cartItem->variation and $terms = $variation->terms())
                    &mdash;
                    @foreach($terms as $k=>$term)
                        @if($k) - @endif
                        {{$term->attribute->name}}: {{$term->name}}
                    @endforeach

                @endif
            @if(!empty($cartItem->meta['package']))
                    <div class="mt-3">{{__('Package: ')}} {{package_key_to_name($cartItem->meta['package'])}} ({{format_money($cartItem->price)}})</div>
                @endif
                @if(!empty($cartItem->meta['extra_prices']))
                    <div class="mt-3"><strong>{{__("Extra Prices:")}}</strong></div>
                    <ul class="list-unstyled mt-2">
                        @foreach($cartItem->meta['extra_prices'] as $extra_price)
                        <li>{{$extra_price['name'] ?? '0'}} : {{format_money($extra_price['price'] ?? 0)}}</li>
                        @endforeach
                    </ul>
                @endif
            </td>
            <td class="product-qty text-center">x {{$cartItem->qty}}</td>
            <td class="product-total text-end">{{format_money($cartItem->subtotal)}}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        @include ('order.checkout.shipping-method')
        <tr class="border-t border-gray-200 py-3" v-if="discount_amount > 0">
            <td class="font-weight-bold">{{__('Discount')}}</td>
            <td></td>
            <td class="text-end">
                <span class="amount">
                    -@{{ discount_amount_html }}
                </span>
            </td>
        </tr>
        <tr class="border-t border-gray-200 py-2" v-if="tax_amount > 0">
            <td class="font-weight-bold">
                {{__('Tax')}} <span v-if="prices_include_tax == 'yes'">({{ __("include") }})</span>
            </td>
            <td></td>
            <td class="text-end">
                <span class="amount">
                    @{{ tax_amount_html }}
                </span>
            </td>
        </tr>
        <tr class="order-total border-t border-gray-200 mt-3">
            <td class="font-bold py-2">{{__('Total')}}</td>
            <td></td>
            <td class="text-end">
                <span class="amount">
                    @{{ total_amount_html }}
                </span>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
