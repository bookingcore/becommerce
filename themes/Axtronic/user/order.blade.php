@extends('layouts.app')
@section('content')
     @include('global.breadcrumb')
    <div class="axtronic-section-account mb-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="fs-24 mb-3">
                        <h3>{{__("Orders")}}</h3>
                    </div>
                    <div class="axtronic-content">
                        <div class="table-responsive">
                            <table class="table axtronic-table">
                                <thead>
                                <tr>
                                    <th>{{__("Id")}}</th>
                                    <th>{{__("Date")}}</th>
                                    <th>{{__("Amount")}}</th>
                                    <th>{{__("Status")}}</th>
                                    <th>{{__("Actions")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr>
                                        <td>#{{$row->id}}</td>
                                        <td>{{display_date($row->created_at)}}</td>
                                        <td>{{format_money($row->total)}}</td>
                                        <td>{{$row->status_text}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{route('user.order.detail',['id'=>$row->id])}}">{{__('View detail')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $rows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
