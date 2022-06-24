@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="mb40">
            <div class="d-flex justify-content-between">
                <h1 class="title-bar">{{$zone['title'] ?? __("System Settings")}}</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <strong><i class="fa fa-cogs"></i> {{ __("Main Settings") }}</strong>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($groups as $id=>$setting)
                            <a class="list-group-item list-group-item-action @if($current_group == $id) active @endif" href="{{!empty($zone_id) ? route('core.admin.setting.zone',['zone_id'=>$zone_id,'group'=>$id]) :  route('core.admin.setting',['group'=>$id])}}">
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
                @include('admin.message')
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('core.admin.setting.store',['group'=>$current_group,'zone_id'=>$zone_id ?? ''])}}" method="post" autocomplete="off">
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
