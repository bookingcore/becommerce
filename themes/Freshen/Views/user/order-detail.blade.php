@extends('layouts.app')
@section('content')
     @include('global.breadcrumb')
    <section class="bc-section-account mb-3 mt-3 fz14">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="fs-24 mb-3">
                        <h3>{{__('Order #')}}{{$order->id}} - <strong>{{$order->status_text}}</strong></h3>
                    </div>
                    <div class="bc-content">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div>{{__('Payment')}}</div>
                                <strong>{{$order->gateway_obj ? $order->gateway_obj->getDisplayName() : ''}}</strong>
                            </div>
                            <div class="col-md-6 col-12">
                                <div>{{$order->shipping_display_name}}</div>
                                <div>{{__('Address')}}: {{$order->shipping_full_address}}</div>
                                <div>{{__('Phone')}}: {{$order->phone}}</div>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table bc-table">
                                <thead>
                                <tr>
                                    <th>{{__('Product')}}</th>
                                    <th>{{__("Price")}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $orderItem)
                                    @php $model = $orderItem->model; @endphp
                                    <tr>
                                        <td>
                                            <a href="{{$model->getDetailUrl()}}">
                                                {{$model ? $model->title : $orderItem->name }} x{{$orderItem->qty}}
                                            </a>
                                            <p>{{__('Sold By')}}:<strong> {{$model->author->display_name}}</strong></p>
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
                                        <td><span>{{format_money($orderItem->price)}}</span></td>
                                        <td>{{$orderItem->qty}}</td>
                                        <td><span>{{format_money($orderItem->subtotal)}}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-sm btn-primary" href="{{route('user.order.index')}}">{{__('Back to orders')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
