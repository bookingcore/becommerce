@extends('layouts.vendor')
@section('content')
    <section class="bc-items-listing">
        <div class="d-flex justify-content-between mb-4">
            <h1>{{$page_title ?? ''}}</h1>
        </div>

        @include('global.message')


        <div class="panel">
            <div class="px-3">@include('vendor.product.filter')</div>
            @if($rows)
            <div class="bc-section__content">
                <div class="table-responsive">
                    <table class="table bc-table" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('SKU')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Categories')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Date')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td>#{{$row->id}}</td>
                                <td>
                                    <a class="text-slate-800" href="{{$row->getDetailUrl()}}">
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
                                <td><strong>{{format_money($row->price)}}</strong></td>
                                <td>{{$row->categories ? $row->categories->pluck('name')->join(', ') : ''}}</td>
                                <td>{{$row->type_name}}</td>
                                <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                                <td>{{display_datetime($row->created_at)}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('vendor.product.sell',['product'=>$row])}}">{{__("Sell this product")}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if(!count($rows))
                    <div class="m-3 alert alert-warning">{{__("No product found")}}</div>
                @endif
                <div class="p-3">{{$rows->appends(request()->query())->links()}}</div>
            </div>
            @else
                <div class="alert alert-info">{{__("Search for product to start selling")}}</div>
            @endif

        </div>
    </section>
@endsection
