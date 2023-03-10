@extends('Layout::admin.app')
@section("content")
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All Themes')}}</h1>
            <div class="title-actions">
                <a href="{{route('theme.admin.upload')}}" class="btn btn-primary"><i class="fa fa-upload"></i> {{__("Upload")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="row">
            @foreach($rows as $theme_id=>$themeClass)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{asset($themeClass::$screenshot)}}" alt="">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-grow-1">
                                <div class="d-flex  align-items-center">
                                    <h5 class="card-title mb-0">{{$themeClass::$name}} </h5>
                                    <span class="ml-3 badge badge-secondary">{{$themeClass::$version}}</span>
                                </div>
                                <div>
                                    @if(\Modules\Theme\ThemeManager::current() == strtolower($theme_id))
                                        <span class="badge badge-success">{{__('Current')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if(\Modules\Theme\ThemeManager::current() == strtolower($theme_id))
                                        <form onsubmit="return confirm('{{__("Do you want to import all demo data?")}}')" action="{{route('theme.admin.seeding',['theme'=>strtolower($theme_id)])}}" method="post">
                                            @csrf
                                            <button class="btn btn-warning"><i class="fa fa-magic"></i> {{__("Import Demo Data")}}</button>
                                            @if($time = $themeClass::lastSeederRun())
                                                <div>
                                                    <i>{{__('Last run: :date',['date'=>display_datetime($time)])}}</i>
                                                </div>
                                            @endif
                                        </form>
                                    @else
                                        <form action="{{route('theme.admin.activate',['theme'=>strtolower($theme_id)])}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary">{{__("Activate")}}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
