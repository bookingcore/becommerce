@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <div class="order-confirmation">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="fs-24">
                    @switch($row->status)
                        @case('completed')
                        <span class="icon fa fa-check"></span>
                        @break
                        @default
                        <span class="icon fa fa-info"></span>
                        @break
                    @endswitch
                        @switch($row->status)
                            @case('completed')
                            {{__('Your order is completed!')}}
                            @break
                            @default
                            {{__('Your order detail')}}
                            @break
                        @endswitch
                    </h4>
                </div>
                <div class="card-body">
                    <div class="text h5 fs-18">
                        @switch($row->status)
                            @case('completed')
                            {{__('Thank you. Your order has been received.')}}
                            @break
                            @default
                            {{__('Here is your order detail')}}
                            @break
                        @endswitch
                    </div>
                    <ul class="order-info list-unstyled">
                        <li>
                            <span>{{__('Order Number')}}</span>
                            <strong>#{{$row->id}}</strong>
                        </li>

                        <li>
                            <span>{{__('Date')}}</span>
                            <strong>{{display_date($row->created_at)}}</strong>
                        </li>

                        <li>
                            <span>{{__('Total')}}</span>
                            <strong>{{format_money($row->total)}}</strong>
                        </li>

                        <li>
                            <span>{{__('Payment Method')}}</span>
                            <strong>{{$row->gateway_obj ? $row->gateway_obj->getDisplayName() : ''}}</strong>
                        </li>
                        <li>
                            <span>{{__('Status')}}</span>
                            <strong>{{$row->status_name}}</strong>
                        </li>
                    </ul>
                    <div class="order-box border-top pt-3">
                        <h4 class="fs-18">{{__('Order details')}}</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><strong>{{__('Product')}}</strong></th>
                                <th width="20%"><strong>{{__('Subtotal')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($row->items as $orderItem)
                                <?php
                                    dump($orderItem);
                                ;?>
                                <?php $model = $orderItem->model; ?>
                                <tr class="cart-item">
                                    <td class="product-name">{{$model ? $model->title : $orderItem->name }} x{{$orderItem->qty}}

                                        @if(!empty($orderItem->meta['package']))
                                            <div class="mt-3">{{__('Package: ')}} {{package_key_to_name($orderItem->meta['package'])}} ({{format_money($orderItem->price)}})</div>
                                        @endif
                                        @if(!empty($orderItem->meta['extra_prices']))
                                            <div class="mt-3"><strong>{{__("Extra Prices:")}}</strong></div>
                                            <ul class="list-unstyled mt-2">
                                                @foreach($orderItem->meta['extra_prices'] as $extra_price)
                                                    <li>{{$extra_price['name'] ?? ''}} : {{format_money($extra_price['price'] ?? 0)}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="product-total">{{format_money($orderItem->subtotal)}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            @if(!empty($row->shipping_amount))
                                <tr class="shipping-amount">
                                    <td>{{__('Shipping Amount')}}</td>
                                    <td><span class="amount">{{format_money($row->shipping_amount )}}</span></td>
                                </tr>
                            @endif
                            @if(!empty($row->shipping_amount))
                                <tr class="shipping-amount">
                                    <td>
                                        {{__('Tax')}} @if($row->getMeta('prices_include_tax') == "yes")<span >({{ __("include") }})</span> @endif
                                    </td>
                                    <td><span class="amount">{{format_money($row->tax_amount )}}</span></td>
                                </tr>
                            @endif

                            @if(!empty($row->discount_amount))
                                <tr class="discount-amount">
                                    <td>{{__('Discount Amount')}}</td>
                                    <td><span class="amount">-{{format_money($row->discount_amount )}}</span></td>
                                </tr>
                            @endif
                            <tr class="order-total">
                                <td>{{__('Total')}}</td>
                                <td><span class="amount">{{format_money($row->total)}}</span></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
                    @include('order.emails.parts.order-address',['order'=>$row])
                </div>
            </div>
        </div>
    </div>
@endsection
