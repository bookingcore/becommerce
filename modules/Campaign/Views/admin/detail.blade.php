@extends('admin.layouts.app')

@section('content')
    <form action="{{route('campaign.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" >
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new campaign.')}}</h1>
                </div>
            </div>
            @include('Layout::admin.message')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("General Information")}}</strong></div>
                            <div class="panel-body">
                                @include('Campaign::admin.form')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        @include('Campaign::admin.products')
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
@endsection
