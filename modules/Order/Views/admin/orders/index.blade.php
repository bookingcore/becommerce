@extends ('admin.layouts.app')
@section ('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{__('All Orders')}}</h1>
    </div>
    @include('Layout::admin.message')
    <div class="filter-div d-flex justify-content-between">
        <div class="col-left">
            <form method="post" action="{{route('order.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
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
                    <tr>
                        <td width="6%">
                            <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">#{{$row->id}}
                        </td>
                        <td width="25%">
                            @if(!empty($items = $row->items))
                            @foreach($items as $item)
                            @php
                            $model =$item->model;
                            @endphp
                            <ul class="list-unstyled order-list">
                                <li>
                                    <div class="media">
                                        <div class="media-left" style="padding-right: 10px">
                                            <div class="thumb" style="width: 50px;">
                                                {!! get_image_tag($model->image_id,'thumb',['lazy'=>false,'style'=>'width:100%']) !!}
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <a target="_blank" href="{{ route('product.detail',['slug'=>$model->slug])}}">{{ $model->title }} x {{ $item->qty }}</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @php
                                $billing = $row->getJsonMeta('billing')
                            @endphp
                            @if(!empty($billing))
                            <ul>
                                <li>{{__("Name:")}} {{$billing['first_name']}} {{$billing['last_name']}} </li>
                                <li>{{__("Email:")}} {{$billing['email']??''}}</li>
                                <li>{{__("Phone:")}} {{$billing['phone']??''}}</li>
                                <li>{{__("Address:")}} {{$billing['address']??''}}</li>
                            </ul>
                                @endif
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
                            @includeIf('Order::admin.orders.detail-modal')
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
