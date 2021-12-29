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
                        @include('global.message')
                        <div class="ps-section--account-setting">
                            <div class="ps-section__header">
                                <h3>{{__('Notifications')}}</h3>
                            </div>
                            <div class="ps-section__content">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link @if(empty($type)) active @endif" href="{{route('user.notification')}}">{{__("All")}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'unread') active @endif" href="{{route('user.notification',['type'=>'unread'])}}">{{__("Unread")}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'read') active @endif" href="{{route('user.notification',['type'=>'read'])}}">{{__("Read")}}</a>
                                    </li>
                                </ul>
                                <div class="ps-card mt-3">
                                    <ul class="list-group">
                                        @if(count($rows)> 0)
                                            @foreach($rows as $oneNotification)
                                                @php
                                                    $active = $class = '';
                                                    $data = json_decode($oneNotification['data']);

                                                    $idNotification = @$data->id;
                                                    $forAdmin = @$data->for_admin;
                                                    $usingData = @$data->notification;

                                                    $services = @$usingData->type;
                                                    $idServices = @$usingData->id;
                                                    $title = @$usingData->message;
                                                    $name = @$usingData->name;
                                                    $avatar = @$usingData->avatar;
                                                    $link = @$usingData->link;

                                                    if(empty($oneNotification->read_at)){
                                                        $class = 'markAsRead';
                                                        $active = 'active';
                                                    }
                                                @endphp
                                                <li class="notification {{$active}}">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <div class="media-object">
                                                                @if($avatar)
                                                                    <img class="image-responsive" src="{{$avatar}}" alt="{{$name}}">
                                                                @else
                                                                    <span class="avatar-text">{{ucfirst($name[0])}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <a class="{{$class}} p-0" data-id="{{$idNotification}}" href="{{$link}}">{!! $title !!}</a>
                                                            <div class="notification-meta">
                                                                <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item">{{__("You don't have any notifications")}}</li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-end">
                                    {{$rows->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
