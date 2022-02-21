@extends('layouts.vendor')
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
                        <th>{{__('Name')}}</th>
                        <th>{{__('SKU')}}</th>
                        <th>{{__('Total')}}</th>
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
                                <span class="d-flex">
                                    <strong>{{$row->model->title ?? ''}}: {{format_money($row->price)}} x {{$row->qty}}</strong>
                                </span>
                            </td>
                            <td>{{$row->model->sku ?? ''}}</td>
                            <td><strong>{{$row->subtotal}}</strong>
                            </td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            <td>{{display_datetime($row->created_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{__("Actions")}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('vendor.product.edit',['id'=>$row->id])}}">{{__("Edit")}}</a>
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
