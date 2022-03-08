@extends ('admin.layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb20">
                    <h1 class="title-bar">{{__('Settings')}}</h1>
                </div>
                <div class="panel">
                    <div class="panel-body pd15">
                        <div class="row area-setting-row">
                            @foreach($settings as $id=>$setting)
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('core.admin.setting',['group'=>$id])}}">
                                            <span class="setting-item-media">
                                                <i class="icon ion-ios-globe"></i>
                                            </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title">{{$setting['title']}}</span>
                                                <span class="setting-item-desc">{{__("Manage languages of your website")}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
