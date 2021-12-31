@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="ps-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ps-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ps-section__right">
                        <div class="ps-section--account-setting">
                            <div class="ps-section__header">
                                <h3>{{__("Orders")}}</h3>
                            </div>
                            <div class="ps-section__content">
                                <div class="table-responsive">
                                    <table class="table ps-table ps-table--invoices">
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
                                                    <a class="ps-btn ps-btn--sm" href="{{route('user.order.detail',['id'=>$row->id])}}">{{__('View detail')}}</a>
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
        </div>
    </div>
@endsection
