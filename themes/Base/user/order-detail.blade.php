@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="ps-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ps-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ps-section__right">
                        <div class="ps-section--account-setting">
                            <div class="ps-section__header">
                                    <h3>{{__('Order #')}}{{$order->id}} - <strong>{{$order->status_text}}</strong></h3>
                            </div>
                            <div class="ps-section__content">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <figure class="ps-block--invoice">
                                            <figcaption>{{__('Address')}}</figcaption>
                                            <div class="ps-block__content"><strong>{{$order->shipping_display_name}}</strong>
                                                <p>{{__('Address')}}: {{$order->shipping_full_address}}</p>
                                                <p>{{__('Phone')}}: {{$order->phone}}</p>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <figure class="ps-block--invoice">
                                            <figcaption>{{__('Shipping Fee')}}</figcaption>
                                            <div class="ps-block__content">
                                                <p></p>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <figure class="ps-block--invoice">
                                            <figcaption>{{__('Payment')}}</figcaption>
                                            <div class="ps-block__content">
                                                <p>{{__("Payment Method")}}: {{$order->gateway_name}}</p>
                                            </div>
                                        </figure>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table ps-table">
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
                                                        <div class="ps-product--cart">
                                                            <div class="ps-product__thumbnail">
                                                                <a href="{{$model->getDetailUrl()}}">
                                                                    {!! get_image_tag($model->image_id,'medium') !!}
                                                                </a>
                                                            </div>
                                                            <div class="ps-product__content"><a href="{{$model->getDetailUrl()}}">{{$model->title}}</a>
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
                            <div class="ps-section__footer"><a class="ps-btn ps-btn--sm" href="{{route('user.order.index')}}">{{__('Back to orders')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
