@extends('layouts.vendor')
@section('content')
<section class="bc-items-listing">
    <div class="d-flex justify-content-between mb-4">
        <h1>{{$page_title ?? ''}}</h1>
        <div class="bc-section__actions"><a class="btn btn-primary" href="{{route('vendor.product.create')}}"><i class="icon icon-plus mr-2"></i>{{__('New Product')}}</a></div>
    </div>

    @include('global.message')

    @include('vendor.product.filter')
    <div class="bc-section__content">
        <div class="table-responsive mih-300">
            <table class="table bc-table">
                <thead>
                <tr>
                    <th>{{__('ID')}}</th>
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
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        <td>#{{$row->id}}</td>
                        <td>
                            <a href="{{route('vendor.product.edit',['id'=>$row->id])}}">
                                <span class="d-flex">
                                    <div class="me-3">
                                        <img src="{{get_file_url($row->image_id)}}" width="60">
                                    </div>
                                    <strong>{{$row->title}}</strong>
                                </span>
                            </a>
                        </td>
                        <td>{{$row->sku}}</td>
                        <td>{{$row->stock}}</td>
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
        {{$rows->appends(request()->query())->links()}}
    </div>
</section>
@endsection
