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
                <table class="table bc-table text-[15px] w-full" cellspacing="0" cellpadding="0">
                    <thead class="bg-[#F3F5F6]">
                    <tr>
                        <th class="p-3 py-4 rounded-l-md font-medium">{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('SKU')}}</th>
                        <th>{{__('Stock')}}</th>
                        <th>{{__('Price')}}</th>
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
                                <a class="flex items-center text-blue-800 hover:text-amber-400" href="{{route('vendor.product.edit',['id'=>$row->id])}}">
                                    <div class="mr-3">
                                        <img src="{{get_file_url($row->image_id)}}" width="60">
                                    </div>
                                    <span class="fw-500">{{$row->title}}</span>
                                </a>
                            </td>
                            <td>
                                @if($row->product_type != "variable")
                                    {{$row->sku}}
                                @endif
                            </td>
                            <td>
                                @if($row->is_manage_stock and $row->quantity)
                                    <span class="badge bg-success">{{__("In stock")}} ({{$row->remain_stock}})</span>

                                @elseif(!$row->is_manage_stock and $row->stock_status == 'in')
                                    <span class="badge bg-success">{{__("In stock")}}</span>
                                @else
                                    <span class="badge bg-danger">{{__("Of of stock")}}</span>
                                @endif
                            </td>
                            <td>{{format_money($row->price)}}</td>
                            <td>{{$row->type_name}}</td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            @if(vendor_product_need_approve())
                                <td >
                                    <span class="badge bg-{{ $row->is_approved ? 'success' : 'secondary' }}">{{ $row->is_approved  ? __("Approved") : '' }}</span>
                                </td>
                            @endif
                            <td>{{display_datetime($row->created_at)}}</td>
                            <td>
                                <div class="be-dropdown relative inline-block text-left">
                                    <div>
                                        <button class="be-dropdown-toggle inline-flex p-3 py-1 rounded items-center border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{__("Actions")}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="be-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1" role="none">
                                            <a class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.product.edit',['id'=>$row->id])}}">{{__("Edit")}}</a>
                                            @if(auth()->user()->hasPermission('product_delete'))
                                                <a class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.product.delete',['id'=>$row->id])}}">{{__("Delete")}}</a>
                                            @endif
                                            <a class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" target="_blank" href="{{$row->getDetailUrl()}}">{{__("View")}}</a>
                                        </div>
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
