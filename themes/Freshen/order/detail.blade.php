@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <section class="order-confirmation">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="order_complete_message text-center">
                        <div class="icon bgc-thm">
                            @switch($row->status)
                                @case('completed')
                                <span class="icon fa fa-check text-white"></span>
                                @break
                                @default
                                <span class="icon fa fa-info text-white"></span>
                                @break
                            @endswitch
                        </div>
                        <h2>
                            @switch($row->status)
                                @case('completed')
                                {{__('Your order is completed!')}}
                                @break
                                @default
                                {{__('Your order detail')}}
                                @break
                            @endswitch
                        </h2>
                        <p class="fz14">
                            @switch($row->status)
                                @case('completed')
                                {{__('Thank you. Your order has been received.')}}
                                @break
                                @default
                                {{__('Here is your order detail')}}
                                @break
                            @endswitch
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="shop_order_box mt40">
                        <div class="order_list_raw">
                            <ul>
                                <li class="list-inline-item">
                                    <p>{{__('Order Number')}}</p>
                                    <h5>#{{$row->id}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p>{{__('Date')}}</p>
                                    <h5>{{display_date($row->order_date)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p>{{__('Total')}}</p>
                                    <h5>{{format_money($row->total)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p>{{__('Payment Method')}}</p>
                                    <h5>{{$row->gateway_obj ? $row->gateway_obj->getDisplayName() : ''}}</h5>
                                </li>
                            </ul>
                        </div>
                        <div class="order_details">
                            <h4 class="title text-center mb40">{{__('ORDER DETAILS')}}</h4>
                            <div class="od_content">
                                <ul>
                                    <li class="subtitle bb1 mb20 pb5"><p>{{__('Product')}} <span class="float-end">{{__('Subtotal')}}</span></p></li>
                                    @foreach($row->items as $orderItem)
                                        <?php $model = $orderItem->model; ?>
                                        <li class="cart-item">
                                            <p class="product_name_qnt">{{$model ? $model->title : $orderItem->name }} x{{$orderItem->qty}}

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
                                                <span class="product-total float-end">{{format_money($orderItem->subtotal)}}</span>
                                            </p>
                                        </li>
                                    @endforeach
                                    @if(!empty($row->shipping_amount) and $row->shipping_amount > 0)
                                        <li class="subtitle bb1 mb20 pb5"><p>{{__('Shipping Amount')}} <span class="float-end">{{format_money($row->shipping_amount )}}</span></p></li>
                                    @endif
                                    @if(!empty($row->discount_amount) and $row->discount_amount > 0)
                                        <li class="subtitle bb1 mb20 pb5"><p>{{__('Discount Amount')}}
                                            <span class="float-end">-{{format_money($row->discount_amount )}}</span></p>
                                        </li>
                                    @endif
                                    @if(!empty($row->tax_amount) and $row->tax_amount > 0)
                                        <li class="subtitle bb1 mb20 pb5"><p>{{__('Tax')}}
                                                 @if($row->getMeta('prices_include_tax') == "yes")<span >({{ __("include") }})</span> @endif
                                            <span class="float-end">{{format_money($row->tax_amount )}}</span></p>
                                        </li>
                                    @endif
                                    <li class="subtitle bb1 mb20 pb5"><p>{{__('Total')}}
                                            <span class="float-end">{{format_money($row->total)}}</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
