@extends('layouts.vendor')
@section('head')
    <style>
        .bc-table .address-title{
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <section class="bc-items-listing">
        <div class="d-flex justify-content-between mb-4">
            <h1>{{$page_title ?? ''}}</h1>
        </div>

        @include('global.message')

        <div class="bc-section__content">
            <div class="table-responsive">
                <table class="table bc-table">
                    <thead>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Product Name')}}</th>
                        <th>{{__('Customer')}}</th>
                        <th>{{__('SKU')}}</th>
                        <th>{{__('Revenue')}}</th>
                        <th>{{__('Fee')}}</th>
                        <th>{{__('Net')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>#{{$row->id}}</td>
                            <td>
                                <strong>{{$row->model->title ?? ''}}: {{format_money($row->price)}} x {{$row->qty}}</strong>
                                {{$row->model->sku ?? ''}}
                            </td>
                            <td>
                                @include('order.emails.parts.order-address',['order'=>$row->order])
                            </td>
                            <td><strong>{{format_money($row->subtotal)}}</strong>
                            <td><strong>{{format_money($row->commission_amount)}}</strong>
                            <td><strong>{{format_money($row->subtotal - $row->commission_amount)}}</strong>
                            </td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            <td>{{display_datetime($row->created_at)}}</td>
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
