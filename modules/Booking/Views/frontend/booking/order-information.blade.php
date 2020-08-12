<div class="booking-review">
    <h4 class="booking-review-title">{{__('Order Information')}}</h4>
    <div class="booking-review-content">
        <div class="review-section">
            <div class="info-form">
                <div class="info-header">
                    <div class="label text-uppercase">{{__('Product')}}</div>
                    <div class="label text-uppercase">{{__('Subtotal')}}</div>
                </div>
                @if($orders_list)
                    @foreach($orders_list as $item)
                        @php $name = \App\User::find($item->vendor_id)->getDisplayName(); @endphp

                        <div class="info-content">
                            <div class="label">
                                <div class="label-name">{{$item->product_name}} x {{$item->qty}}</div>
                                <div class="label-by"><span>{{__('Sold by:')}}</span> {{$name}}</div>
                            </div>
                            <div class="val">{{format_money($item->qty * $item->price)}}</div>
                        </div>
                    @endforeach
                @endif

                @if($order)
                    @if($order->coupons && is_array(json_decode($order->coupons)))
                        @foreach(json_decode($order->coupons) as $coupon)
                            @php $coupon_discount = ($coupon->type == 'percent') ? $coupon->discount/100 : $coupon->discount  @endphp
                            <div class="info-content info-coupon">
                                <div class="label text-uppercase">{{ __('Coupon: :coupon',['coupon'=>$coupon->name]) }}</div>
                                <div class="val">-{{ ($coupon->type == 'percent') ? format_money($order->total * $coupon_discount) : format_money($coupon_discount) }}</div>
                            </div>
                        @endforeach
                    @endif
                    <div class="info-total">
                        <div class="label text-uppercase">{{__('Total')}}</div>
                        <div class="val">{{ format_money($order->final_total) }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

