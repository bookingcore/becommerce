@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Plugins")}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('plugin.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="active">{{__("Active")}}</option>
                            <option value="deactivate">{{__("Deactivate")}}</option>
                        </select>
                        <button class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <div class="bc-form-item">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th width="200px"> {{ __('Plugin name')}}</th>
                            <th > {{ __('Description')}}</th>
                            <th width="200px"> {{ __('Author')}}</th>
                            <th width="100px"> {{ __('Version')}}</th>
                            <th width="100px">{{__("Actions")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($rows))
                            @foreach($rows as $key=>$row)
                                <tr class="">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="{{$key}}">
                                    </td>
                                    <td class="title">
                                        <i style="font-size: 18px" class="icon-check icon ion-ios-checkmark-circle mr-2  @if(in_array($key,$active_plugins)) text-success @endif"></i>
                                        <a href="#">{{$row::$name}}</a>
                                    </td>
                                    <td>
                                        {{$row::$desc}}
                                    </td>
                                    <td>
                                        {{$row::$author}}
                                    </td>
                                    <td>
                                        {{$row::$version}}
                                    </td>
                                    <td>
                                        <form action="{{route('plugin.admin.active',['plugin'=>$key])}}" method="post">
                                            @csrf
                                            @if(!in_array($key,$active_plugins))
                                                <button class="btn btn-primary btn-sm" value="1" name="active">{{__("Active")}}</button>
                                            @else
                                                <button class="btn btn-warning btn-sm" value="0" name="active">{{__("Deactive")}}</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{__("No items found")}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
