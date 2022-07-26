@if(is_vendor_page())
    @include('layouts.vendor.notification')
    <?php return ?>
@endif
<?php

$checkNotify = \Modules\Core\Models\NotificationPush::query();
if(is_admin()){
    $checkNotify->where(function($query){
        $query->where('data', 'LIKE', '%"for_admin":1%');
        $query->orWhere('notifiable_id', Auth::id());
    });
}else{
    $checkNotify->where('data', 'LIKE', '%"for_admin":0%');
    $checkNotify->where('notifiable_id', Auth::id());
}
$notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();
$countUnread = $checkNotify->where('read_at', null)->count();
?>
<li class="notifications-item">
    <div class="site-header-notifications">
        <a class="notifications-contents is_login" href="#">
            <span class="group-icon-action">
                <i class="axtronic-icon-envelope"></i>
                <span class="count">{{$countUnread}}</span>
            </span>
        </a>
    </div>
</li>
<div class="site-notifications-side side-wrap">
    <a href="#" class="close-notifications-side close-side"><span class="screen-reader-text">{{__('Close')}}</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">{{__('Notifications') }} (<span class="notif-count">{{$countUnread}}</span>)</span>
    </div>
    <div class="notifications-side-wrap-content side-wrap-content">
        <div class="axtronic-content-scroll">
            <div class="axtronic-card-content">
                @if(count($notifications)> 0)
                    <ul>
                        @foreach($notifications as $oneNotification)
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
                            <li class="list-group-item list-group-item-action {{$active}}">
                                <a class="{{$class}} p-0" data-id="{{$idNotification}}" href="{{$link}}">
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
                                            {!! $title !!}
                                            <div class="notification-meta">
                                                <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="axtronic-content-mid-notice">
                        {{__('No notification')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="axtronic-notifications-bottom d-grid">
            <a class="btn" href="{{route('user.notification')}}"><span>{{__('View More')}}</span></a>
        </div>
    </div>
</div>
<div class="notifications-side-overlay side-overlay"></div>
