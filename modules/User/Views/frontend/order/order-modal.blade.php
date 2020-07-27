<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        @if(!empty($order))
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Order ID: #:id',['id'=>$id]) }}</h4>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#booking-detail">{{ __('Order Detail') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#booking-customer">{{__('Billing address')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#shipping-address">{{__('Shipping address')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="booking-detail" class="tab-pane fade active show">
                            <br>
                            <div class="booking-review">
                                <div class="booking-review-content">
                                    <div class="review-section">
                                        <div class="info-form">
                                            <ul>
                                                <li class="text-uppercase font-weight-bold info-header">
                                                    <div class="label">{{ __('Product') }}</div>
                                                    <div class="val">{{ __('Total') }}</div>
                                                </li>
                                                @php $total_suborder = ''; @endphp
                                                @if(!empty($suborder))
                                                    @foreach($suborder as $item)
                                                        @php $user = \App\User::find($item->vendor_id); $total_suborder = format_money($item->price); @endphp
                                                        <li class="info-content">
                                                            <div class="label">
                                                                <div class="name">{{ $item->product_name }} x {{ $item->qty }}</div>
                                                                <div class="sold-by"><span style="font-weight: 600">{{ __('Sold by:') }}</span> {{$user->getDisplayName()}}</div>
                                                            </div>
                                                            <div class="val" style="color: red">{{format_money($item->qty * $item->price)}}</div>
                                                        </li>
                                                    @endforeach
                                                @endif

                                                @if($order->coupons && is_array(json_decode($order->coupons)) && $is_suborder != 'true')
                                                    @foreach(json_decode($order->coupons) as $coupon)
                                                        @php $coupon_discount = ($coupon->type == 'percent') ? $coupon->discount/100 : $coupon->discount  @endphp
                                                        <li class="info-content info-coupon">
                                                            <div class="label text-uppercase">{{ __('Coupon: :coupon',['coupon'=>$coupon->name]) }}</div>
                                                            <div class="val" style="color: red">-{{ ($coupon->type == 'percent') ? format_money($order->total * $coupon_discount) : format_money($coupon_discount) }}</div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                                <li class="info-total">
                                                    <div class="label text-uppercase">{{__('Total')}}</div>
                                                    <div class="val">{{ ($is_suborder == 'true') ? $total_suborder : format_money($order->final_total) }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="booking-customer" class="tab-pane">
                            <br>
                            <div class="booking-review">
                                <div class="booking-review-content">
                                    <div class="review-section">
                                        <div class="info-form">
                                            <ul>
                                                <li class="info-first-name">
                                                    <div class="label">{{ __('First name') }}</div>
                                                    <div class="val">{{ $order->first_name ?? '' }}</div>
                                                </li>
                                                <li class="info-last-name">
                                                    <div class="label">{{ __('Last name') }}</div>
                                                    <div class="val">{{ $order->last_name ?? '' }}</div>
                                                </li>
                                                <li class="info-email">
                                                    <div class="label">{{ __('Email') }}</div>
                                                    <div class="val">{{ $order->email ?? '' }}</div>
                                                </li>
                                                <li class="info-phone">
                                                    <div class="label">{{ __('Phone') }}</div>
                                                    <div class="val">{{ $order->phone ?? '' }}</div>
                                                </li>
                                                <li class="info-company">
                                                    <div class="label">{{ __('Company name') }}</div>
                                                    <div class="val">{{ $order->company ?? '' }}</div>
                                                </li>
                                                <li class="info-address">
                                                    <div class="label">{{ __('Address line 1') }}</div>
                                                    <div class="val">{{ $order->address ?? '' }}</div>
                                                </li>
                                                <li class="info-address2">
                                                    <div class="label">{{ __('Address line 2') }}</div>
                                                    <div class="val">{{ $order->address2 ?? '' }}</div>
                                                </li>
                                                <li class="info-city">
                                                    <div class="label">{{ __('City') }}</div>
                                                    <div class="val">{{ $order->city ?? '' }}</div>
                                                </li>
                                                <li class="info-state">
                                                    <div class="label">{{ __('State/Province/Region') }}</div>
                                                    <div class="val">{{ $order->state ?? '' }}</div>
                                                </li>
                                                <li class="info-zip-code">
                                                    <div class="label">{{ __('ZIP code/Postal code') }}</div>
                                                    <div class="val">{{ $order->postcode ?? '' }}</div>
                                                </li>
                                                <li class="info-country">
                                                    <div class="label">{{ __('Country') }}</div>
                                                    <div class="val">{{ get_country_name($order->country) ?? '' }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="shipping-address" class="tab-pane">
                            <br>
                            <div class="booking-review">
                                <div class="booking-review-content">
                                    <div class="review-section">
                                        <div class="info-form">
                                            <ul>
                                                <li class="info-first-name">
                                                    <div class="label">{{ __('First name') }}</div>
                                                    <div class="val">{{ $order->shipping_first_name ?? '' }}</div>
                                                </li>
                                                <li class="info-last-name">
                                                    <div class="label">{{ __('Last name') }}</div>
                                                    <div class="val">{{ $order->shipping_last_name ?? '' }}</div>
                                                </li>
                                                <li class="info-email">
                                                    <div class="label">{{ __('Email') }}</div>
                                                    <div class="val">{{ $order->email ?? '' }}</div>
                                                </li>
                                                <li class="info-phone">
                                                    <div class="label">{{ __('Phone') }}</div>
                                                    <div class="val">{{ $order->phone ?? '' }}</div>
                                                </li>
                                                <li class="info-company">
                                                    <div class="label">{{ __('Company name') }}</div>
                                                    <div class="val">{{ $order->shipping_company ?? '' }}</div>
                                                </li>
                                                <li class="info-address">
                                                    <div class="label">{{ __('Address line 1') }}</div>
                                                    <div class="val">{{ $order->shipping_address ?? '' }}</div>
                                                </li>
                                                <li class="info-address2">
                                                    <div class="label">{{ __('Address line 2') }}</div>
                                                    <div class="val">{{ $order->shipping_address2 ?? '' }}</div>
                                                </li>
                                                <li class="info-city">
                                                    <div class="label">{{ __('City') }}</div>
                                                    <div class="val">{{ $order->shipping_city ?? '' }}</div>
                                                </li>
                                                <li class="info-state">
                                                    <div class="label">{{ __('State/Province/Region') }}</div>
                                                    <div class="val">{{ $order->shipping_state ?? '' }}</div>
                                                </li>
                                                <li class="info-zip-code">
                                                    <div class="label">{{ __('ZIP code/Postal code') }}</div>
                                                    <div class="val">{{ $order->shipping_postcode ?? '' }}</div>
                                                </li>
                                                <li class="info-country">
                                                    <div class="label">{{ __('Country') }}</div>
                                                    <div class="val">{{ get_country_name($order->shipping_country) ?? '' }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <span class="btn btn-secondary" data-dismiss="modal">Close</span>
                </div>
            </div>
        @endif
    </div>
</div>
















{{--<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">


    </div>
</div>--}}
