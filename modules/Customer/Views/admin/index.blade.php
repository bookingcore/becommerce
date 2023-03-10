@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All Customers')}}</h1>
            <div class="title-actions">
                <a href="{{route('customer.admin.create',['user_type'=>"customer"])}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{ __('Add new customer')}}</a>
                <a class="btn btn-warning btn-icon" href="{{ route("customer.admin.export",['role_id'=>2]) }}" target="_blank" title="{{ __("Export to excel") }}">
                    <i class="icon ion-md-cloud-download"></i> {{ __("Export to excel") }}
                </a>
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('customer.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="publish">{{__("Mark as Publish")}}</option>
                            <option value="blocked">{{__("Mark as Block")}}</option>
                            <option value="delete">{{__(" Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-default btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
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
                <form action="" class="bc-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th width="100">{{__('Status')}}</th>
                            <th class="date" width="100">{{ __('Date')}}</th>
                            <th width="100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item"></td>
                                <td class="title">
                                    <a href="{{route('customer.admin.edit',['id'=>$row->id])}}">{{$row->display_name}}</a>
                                </td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td><span class="badge badge-{{$row->status_badge}}">{{$row->status_text}}</span>
                                </td>
                                <td>{{ display_date($row->created_at)}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("Actions")}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"  href="{{route('customer.admin.edit',['id'=>$row->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            <a class="dropdown-item" href="{{url('admin/module/user/password/'.$row->id)}}"><i class="fa fa-lock"></i> {{__('Change Password')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
