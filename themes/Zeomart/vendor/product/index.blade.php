@extends('layouts.vendor')
@section('content')
<section class="bc-items-listing">
    <div class="flex justify-between mb-16">
        <h1 class="text-3xl font-medium">{{$page_title ?? ''}}</h1>
        <div class="bc-section__actions"><a class="btn transition duration-200 bg-amber-400 hover:bg-amber-300" href="{{route('vendor.product.create')}}"><i class="icon icon-plus mr-2"></i>{{__('New Product')}}</a></div>
    </div>

    @include('global.message')

    <div class="panel">
        <div class="mb-5">@include('vendor.product.filter')</div>
        <div class="bc-section__content">
            <div class="table-responsive mih-300">
                <table class="table bc-table text-base" cellspacing="0" cellpadding="0">
                    <thead class="bg-[#F3F5F6]">
                    <tr>
                        <th class="p-3 rounded-l-md font-medium">{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('SKU')}}</th>
                        <th>{{__('Stock')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Categories')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Status')}}</th>
                        @if(vendor_product_need_approve())
                            <th > {{ __('Approved?')}}</th>
                        @endif
                        <th>{{__('Date')}}</th>
                        <th class="p-3 rounded-r-md font-medium"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>#{{$row->id}}</td>
                            <td>
                                <a class="text-slate-800" href="{{route('vendor.product.edit',['id'=>$row->id])}}">
                                <span class="d-flex">
                                    <div class="me-3">
                                        <img src="{{get_file_url($row->image_id)}}" width="60">
                                    </div>
                                    <span class="fw-500">{{$row->title}}</span>
                                </span>
                                </a>
                            </td>
                            <td>
                                @if($row->product_type != "variable")
                                    {{$row->sku}}
                                @endif
                            </td>
                            <td>
                                @if($row->is_manage_stock and $row->quantity)
                                    <strong class="text-success">{{__("In stock")}} ({{$row->remain_stock}})</strong>

                                @elseif(!$row->is_manage_stock and $row->stock_status == 'in')
                                    <strong class="text-success">{{__("In stock")}}</strong>
                                @else
                                    <strong class="text-danger">{{__("Of of stock")}}</strong>
                                @endif
                            </td>
                            <td><strong>{{format_money($row->price)}}</strong></td>
                            <td>{{$row->categories ? $row->categories->pluck('name')->join(', ') : ''}}</td>
                            <td>{{$row->type_name}}</td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            @if(vendor_product_need_approve())
                                <td >
                                    <span class="badge bg-{{ $row->is_approved ? 'success' : 'secondary' }}">{{ $row->is_approved  ? __("Approved") : '' }}</span>
                                </td>
                            @endif
                            <td>{{display_datetime($row->created_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{__("Actions")}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('vendor.product.edit',['id'=>$row->id])}}">{{__("Edit")}}</a>
                                        @if(auth()->user()->hasPermission('product_delete'))
                                            <a class="dropdown-item btn-confirm-del" href="{{route('vendor.product.delete',['id'=>$row->id])}}">{{__("Delete")}}</a>
                                        @endif
                                        <a class="dropdown-item" target="_blank" href="{{$row->getDetailUrl()}}">{{__("View")}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(!count($rows))
                <div class="alert alert-warning">{{__("No data found")}}</div>
            @endif
            <div class="p-3">{{$rows->appends(request()->query())->links()}}</div>
        </div>
    </div>
</section>
@endsection
