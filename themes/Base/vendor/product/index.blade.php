@extends('layouts.vendor')
@section('content')
<section class="ps-items-listing">
    <div class="ps-section__actions"><a class="ps-btn success" href="{{route('vendor.product.create')}}"><i class="icon icon-plus mr-2"></i>{{__('New Product')}}</a></div>
    @include('vendor.product.filter')
    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('SKU')}}</th>
                    <th>{{__('Stock')}}</th>
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
                            <a href="{{route('vendor.product.edit',['id'=>$row->id])}}">
                                <strong>{{$row->title}}</strong>
                            </a>
                        </td>
                        <td>{{$row->sku}}</td>
                        <td>{{$row->stock}}</td>
                        <td><strong>{{format_money($row->price)}}</strong></td>
                        <td>{{$row->categories ? $row->categories->pluck('name')->join(', ') : ''}}</td>
                        <td>{{display_datetime($row->created_at)}}</td>
                        <td><span class="badge badge-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                    {{__("Actions")}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('vendor.product.edit',['id'=>$row->id])}}">{{__("Edit")}}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
