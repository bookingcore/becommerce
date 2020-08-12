@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('All Orders')}}</h1>
        </div>
        @include('Layout::admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                <form method="post" action="{{route('booking.admin.order.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                    @csrf
                    <select name="action" class="form-control">
                        <option value="">{{__("-- Bulk Actions --")}}</option>
                        @if(!empty($statues))
                            @foreach($statues as $status)
                                <option value="{{$status}}">{{__('Mark as: :name',['name'=>ucfirst($status)])}}</option>
                            @endforeach
                        @endif
                        <option value="delete">{{__("DELETE orders")}}</option>
                    </select>
                    <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                </form>
            </div>
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                    @csrf
                    @if(!empty($booking_manage_others))
                        <?php
                        $user = !empty(Request()->vendor_id) ? App\User::find(Request()->vendor_id) : false;
                        \App\Helpers\AdminForm::select2('vendor_id', [
                            'configs' => [
                                'ajax'        => [
                                    'url'      => url('/admin/module/user/getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Vendor --')
                            ]
                        ], !empty($user->id) ? [
                            $user->id,
                            $user->name_or_email . ' (#' . $user->id . ')'
                        ] : false)
                        ?>
                    @endif
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                    <button class="btn-info btn btn-icon" type="submit">{{__('Filter')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Orders')}}</div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Orders')}}</th>
                            <th>{{__('Customer')}}</th>

                            <th>{{__('Total')}}</th>
                            <th width="80px">{{__('Status')}}</th>
                            <th width="150px">{{__('Payment Method')}}</th>
                            <th width="120px">{{__('Created At')}}</th>
                            <th width="80px">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            @php
                                $booking = $row;
                                $suborder = \Modules\Product\Models\OrderItem::where('order_id',$row->id)->get();
                            @endphp
                            <tr>
                                <td width="6%">
                                    <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">#{{$row->id}}
                                </td>
                                <td width="25%">
                                    @if(!empty($suborder))
                                        @foreach($suborder as $order)
                                            @php
                                                $product = \Modules\Product\Models\Product::where('id',$order->product_id)->first();
                                            @endphp
                                            <ul class="list-unstyled order-list">
                                                <li>
                                                    <div class="media">
                                                        <div class="media-left" style="padding-right: 10px">
                                                            <div class="thumb" style="width: 50px;">
                                                                {!! get_image_tag($product->image_id,'thumb',['lazy'=>false,'style'=>'width:100%']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <a href="{{ route('product.detail',['slug'=>$product->slug])}}">{{ $order->product_name }} x {{ $order->qty }}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Name:")}} {{$row->first_name}} {{$row->last_name}} </li>
                                        <li>{{__("Email:")}} {{$row->email}}</li>
                                        <li>{{__("Phone:")}} {{$row->phone}}</li>
                                        <li>{{__("Address:")}} {{$row->address}}</li>
                                        <li>{{__("Custom Requirement:")}} {{$row->customer_notes}}</li>
                                    </ul>
                                </td>
                                <td>{{format_money($row->total)}}</td>
                                <td>
                                    <span class="label label-{{$row->status}}">{{$row->statusName}}</span>
                                </td>
                                <td>
                                    {{$row->gatewayObj ? $row->gatewayObj->getDisplayName() : ''}}
                                </td>
                                <td>{{display_datetime($row->updated_at)}}</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-order-{{$row->id}}" type="button">{{ __('Detail') }}</button>
                                    <div class="modal fade" id="modal-order-{{$row->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('Order ID: ')}} #{{$row->id}}</h4>
                                                </div>

                                                <div class="modal-body">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#order-detail-{{$row->id}}">{{__('Order Detail')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#order-customer-{{$row->id}}">
                                                                {{ __('Customer Information') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div id="order-detail-{{$row->id}}" class="tab-pane active">
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

                                                                                @if($row->coupons && is_array(json_decode($row->coupons)))
                                                                                    @foreach(json_decode($row->coupons) as $coupon)
                                                                                        @php $coupon_discount = ($coupon->type == 'percent') ? $coupon->discount/100 : $coupon->discount  @endphp
                                                                                        <li class="info-content info-coupon">
                                                                                            <div class="label text-uppercase">{{ __('Coupon: :coupon',['coupon'=>$coupon->name]) }}</div>
                                                                                            <div class="val" style="color: red">-{{ ($coupon->type == 'percent') ? format_money($row->total * $coupon_discount) : format_money($coupon_discount) }}</div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                                <li class="info-total">
                                                                                    <div class="label text-uppercase">{{__('Total')}}</div>
                                                                                    <div class="val">{{ format_money($row->final_total) }}</div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="order-customer-{{$row->id}}" class="tab-pane fade">
                                                            <br>
                                                            <div class="booking-review">
                                                                <h4 class="booking-review-title">{{ __('Your Information') }}</h4>
                                                                <div class="booking-review-content">
                                                                    <div class="review-section">
                                                                        <div class="info-form">
                                                                            <ul>
                                                                                <li class="info-first-name">
                                                                                    <div class="label">{{ __('First name') }}</div>
                                                                                    <div class="val">{{ $row->first_name ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-last-name">
                                                                                    <div class="label">{{ __('Last name') }}</div>
                                                                                    <div class="val">{{ $row->last_name ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-email">
                                                                                    <div class="label">{{ __('Email') }}</div>
                                                                                    <div class="val">{{ $row->email ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-phone">
                                                                                    <div class="label">{{ __('Phone') }}</div>
                                                                                    <div class="val">{{ $row->phone ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-company">
                                                                                    <div class="label">{{ __('Company name') }}</div>
                                                                                    <div class="val">{{ $row->company ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-address">
                                                                                    <div class="label">{{ __('Address line 1') }}</div>
                                                                                    <div class="val">{{ $row->address ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-address2">
                                                                                    <div class="label">{{ __('Address line 2') }}</div>
                                                                                    <div class="val">{{ $row->address2 ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-city">
                                                                                    <div class="label">{{ __('City') }}</div>
                                                                                    <div class="val">{{ $row->city ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-state">
                                                                                    <div class="label">{{ __('State/Province/Region') }}</div>
                                                                                    <div class="val">{{ $row->state ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-zip-code">
                                                                                    <div class="label">{{ __('ZIP code/Postal code') }}</div>
                                                                                    <div class="val">{{ $row->postcode ?? '' }}</div>
                                                                                </li>
                                                                                <li class="info-country">
                                                                                    <div class="label">{{ __('Country') }}</div>
                                                                                    <div class="val">{{ get_country_name($row->country) ?? '' }}</div>
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
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$rows->links()}}
        </div>
    </div>
@endsection
