@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Campaign")}}</h1>
        </div>
        @include('Layout::admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Add Campaign")}}</div>
                    <div class="panel-body">
                        <form action="{{route('campaign.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                            @csrf
                            @include('Campaign::admin.form')
                            <hr>
                            <div class="">
                                <button class="btn btn-success" type="submit">{{__("Add new")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('campaign.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Actions ")}}</option>
                                    <option value="publish">{{__("Move to Publish")}}</option>
                                    <option value="draft">{{__("Move to Draft")}}</option>
                                    <option value="delete">{{__("Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-default btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                            <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                            <button class="btn-default btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                    <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="bc-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="60px"><input type="checkbox" class="check-all"></th>
                                        <th> {{ __('Name')}}</th>
                                        <th>{{__('Discount')}}</th>
                                        <th width="130px">{{__('Start date')}}</th>
                                        <th width="130px">{{__('End date')}}</th>
                                        <th width="100px"> {{ __('Status')}}</th>
                                        <th width="100px"> {{ __('Date')}}</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($rows->total() > 0)
                                        @foreach($rows as $row)
                                            <tr class="{{$row->status}}">
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                                </td>
                                                <td class="title">
                                                    <a href="{{route('campaign.admin.edit',['id'=>$row->id])}}">{{$row->title ? $row->title : __('(Untitled)')}}</a>
                                                </td>
                                                <td>{{$row->discount_percent}}%</td>
                                                <td>{{display_datetime($row->start_date)}}</td>
                                                <td>{{display_datetime($row->end_date)}}</td>
                                                <td><span class="badge badge-{{ $row->status_badge }}">{{ $row->status }}</span></td>

                                                <td>{{ display_date($row->updated_at)}}</td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                            {{__("Actions")}}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="{{route('campaign.admin.edit',['id'=>$row->id])}}" class="dropdown-item"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">{{__("No campaign found")}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
