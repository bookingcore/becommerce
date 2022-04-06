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
<li class="dropdown-notifications dropdown p-0">
    <a href="#" data-bs-toggle="dropdown" class="is_login nav-link text-white position-relative">
        <span class="position-relative">
            <i class="fa fa-bell mr-2"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">{{$countUnread}}</span>
        </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-end miw-300 p-3">
        <li class="dropdown-toolbar d-flex justify-content-between align-items-center pb-2 mb-2">
            <h3 class="dropdown-toolbar-title fs-16 mb-0">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>
            <div class="dropdown-toolbar-actions">
                <a href="#" class="markAllAsRead fs-14">{{__('Mark all as read')}}</a>
            </div>
        </li>
        <li class="list-group">
            <ul>
            @if(count($notifications)> 0)
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
            @else
                <a href="#" class="list-group-item list-group-item-action">
                    <span class="fs-14">{{ __("No notification") }}</span>
                </a>
            @endif
            </ul>
        </li>
        <li class="dropdown-footer text-end mt-3 fs-14">
            <a class="btn btn-primary fs-14 c-white" href="{{route('user.notification')}}">{{__('View More')}}</a>
        </li>
    </ul>
</li>
