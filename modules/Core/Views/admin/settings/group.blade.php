@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="icon ion-ios-cog mr-2" style="font-size: 24px"></i>
                        <strong> {{__("Settings")}}</strong>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($groups as $id=>$setting)
                            <a class="list-group-item list-group-item-action @if($current_group == $id) active @endif" href="{{route('core.admin.setting',['group'=>$id])}}">
                                @if(!empty($setting['icon']))
                                    <i class="{{$setting['icon']}}"></i>
                                @endif
                                {{$setting['title']}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-10">

                <div class="mb40">
                    <div class="d-flex justify-content-between">
                        <h1 class="title-bar">{{$group['title']}}</h1>
                    </div>
                    <hr>
                </div>
                @include('admin.message')
                <div class="row">
                    <div class="col-md-3 d-none">
                        <div class="panel">
                            <div class="panel-title">{{__('Settings Groups')}}</div>
                            <div class="panel-body">
                                <ul class="panel-navs">
                                    @foreach($groups as $k=>$row)
                                        <li class="@if($current_group == $k) active @endif"><a href="{{url('admin/module/core/settings/index/'.$k)}}">
                                                @if(!empty($row['icon']))
                                                    <i class="{{$row['icon']}}"></i>
                                                @endif
                                                {{$row['title']}}
                                            </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="{{url('admin/module/core/settings/store/'.$current_group)}}" method="post" autocomplete="off">
                            @csrf

                            @include('Language::admin.navigation')

                            <div class="lang-content-box">
                                @if(empty($group['view']))
                                    @include ('Core::admin.settings.groups.'.$current_group)
                                @else
                                    @include ($group['view'])
                                @endif
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <span></span>
                                <button class="btn btn-primary" type="submit">{{__('Save settings')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
