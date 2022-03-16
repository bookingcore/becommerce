@extends('admin.layouts.app')
@section('content')
    <form action="{{route('user.admin.role.store', ['id' => ($row->id) ? $row->id : '-1'])}}" method="post">
        @csrf
        @include('admin.message')
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->name : 'Add new role'}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Role Content')}} </h3>
                            <div class="form-group">
                                <label>{{ __('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{$row->name}}" required placeholder="{{ __('Role Name')}}" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Commission Type')}}</label>
                                <select class="form-control" name="commission_type">
                                    <option value="default">{{__("-- Default global config -- ")}}</option>
                                    <option value="percent" @if($row->commission_type == 'percent') selected @endif > {{__("Percent")}}</option>
                                    <option value="amount" @if($row->commission_type == 'amount') selected @endif >{{__("Amount")}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Commission')}}</label>
                                <input type="number" value="{{$row->commission}}" placeholder="{{ __('Commission')}}" name="commission" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
@section ('script.body')
@endsection
