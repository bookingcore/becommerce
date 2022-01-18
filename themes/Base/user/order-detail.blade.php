@extends('layouts.app')
@section('content')
     @include('global.breadcrumb')
    <div class="bc-section-account mb-3 mt-3">
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
                            <div class="col-md-4 col-12">
                                <figure class="bc-block--invoice">
                                    <figcaption>{{__('Address')}}</figcaption>
                                    <div class="bc-block__content"><strong>{{$order->shipping_display_name}}</strong>
                                        <p>{{__('Address')}}: {{$order->shipping_full_address}}</p>
                                        <p>{{__('Phone')}}: {{$order->phone}}</p>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-md-4 col-12">
                                <figure class="bc-block--invoice">
                                    <figcaption>{{__('Shipping Fee')}}</figcaption>
                                    <div class="bc-block__content">
                                        <p></p>
                                    </div>
                                </figure>
                            </div>
                            <div class="col-md-4 col-12">
                                <figure class="bc-block--invoice">
                                    <figcaption>{{__('Payment')}}</figcaption>
                                    <div class="bc-block__content">
                                        <p>{{__("Payment Method")}}: {{$order->gateway_name}}</p>
                                    </div>
                                </figure>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                                    <?php  $model = $orderItem->model();?>
                                    <tr>
                                        <td>
                                            <div class="bc-product--cart">
                                                <div class="bc-product__thumbnail">
                                                    <a href="{{$model->getDetailUrl()}}">
                                                        {!! get_image_tag($model->image_id,'medium') !!}
                                                    </a>
                                                </div>
                                                <div class="bc-product__content"><a href="{{$model->getDetailUrl()}}">{{$model->title}}</a>
                                                    <p>{{__('Sold By')}}:<strong> {{$model->author->display_name}}</strong></p>
                                                </div>
                                            </div>
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
                    <div class="bc-section__footer"><a class="btn btn--sm" href="{{route('user.order.index')}}">{{__('Back to orders')}}</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
