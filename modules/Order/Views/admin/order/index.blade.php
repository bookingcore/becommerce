@extends ('admin.layouts.app')
@section ('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{__('All Orders')}}</h1>
        @has_permission('order_create')
            <a href="{{route('order.admin.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{__("Create order")}}</a>
        @end_has_permission
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
                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-default btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
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
                <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name or ID')}}" class="form-control">
                <button class="btn-default btn btn-icon" type="submit">{{__('Filter')}}</button>
            </form>
        </div>
    </div>
    <div class="text-right">
        <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
    </div>
    <div class="panel booking-history-manager">
        <div class="panel-title">{{__('Orders')}}</div>
        <div class="panel-body">
            <form action="" class="bc-form-item">
                <table class="table table-hover bravo-list-item">
                    <thead>
                    <tr>
                        <th width="80px"><input type="checkbox" class="check-all"></th>
                        <th>{{__('Orders')}}</th>
                        <th>{{__('Customer')}}</th>

                        <th>{{__('Total')}}</th>
                        <th>{{__('Tax')}} ({{\Modules\Product\Models\TaxRate::isPriceInclude() ? __("Include") : __("Exclude")}})</th>
                        <th>{{__('Commission')}}</th>
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
                            $model = $item->model;
                            @endphp
                            @if(!empty($model->id))
                                <ul class="list-unstyled order-list">
                                    <li>
                                        <div class="media">
                                            @if($model->image_id)
                                            <div class="media-left" style="padding-right: 10px">
                                                <div class="thumb" style="width: 50px;">
                                                    <img src="{{get_file_url($model->image_id)}}" width="50px" alt="">
                                                </div>
                                            </div>
                                            @endif
                                            <div class="media-body">
                                                <a target="_blank" href="{{ route('product.detail',['slug'=>$model->slug])}}">{{ $model->title }} x {{ $item->qty }}</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @else
                                {{ __("[Item Deleted]") }}
                            @endif
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
                        <td>{{format_money($row->tax_amount)}}</td>
                        <td>{{format_money($row->items->sum('commission_amount'))}}</td>
                        <td>
                            <span class="badge badge-{{$row->status_badge}}">{{$row->status_text}}</span>
                        </td>
                        <td>
                            {{$row->gatewayObj ? $row->gatewayObj->getDisplayName() : ''}}
                        </td>
                        <td>{{display_datetime($row->updated_at)}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                    {{__('Actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-order" data-id="{{$row->id}}" data-ajax="{{route('order.modal',['code'=>$row->code])}}" type="button"><i class="fa fa-eye"></i> {{ __('Detail') }}</a>
                                    @has_permission('order_update')
                                        <a class="dropdown-item" href="{{route('order.admin.edit',['order'=>$row])}}"><i class="fa fa-edit"></i> {{__("Edit")}}</a>
                                    @end_has_permission
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
        {{$rows->withQueryString()->links()}}
    </div>
</div>
<div class="modal" tabindex="-1" id="modal-order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Order ID: #')}} <span class="order_id"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">{{__("Loading...")}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script.body')
<script>

    $('#modal-order').on('show.bs.modal',function (e){
        console.log(e)
        var btn = $(e.relatedTarget);
        $(this).find('.order_id').html(btn.data('id'));
        $(this).find('.modal-body').html('<div class="d-flex justify-content-center">{{__("Loading...")}}</div>');
        var modal = $(this);
        $.get(btn.data('ajax'), function (html){
                modal.find('.modal-body').html(html);
            }
        )
    })
</script>
@endpush
