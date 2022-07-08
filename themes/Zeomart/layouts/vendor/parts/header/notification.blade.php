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
<li class="dropdown-notifications be-dropdown relative rounded-[16px] hover:bg-[#F3F5F6] transition duration-200 group ">
    <a href="#" class="is_login relative block  px-4 py-3.5">
        <span class="relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="absolute -top-1 -right-1 rounded-md bg-amber-400 p-0.5">{{$countUnread}}</span>
        </span>
    </a>
    <ul class="be-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y">
        <div class="dropdown-toolbar d-flex justify-content-between align-items-center pb-2 mb-2">
            <h3 class="dropdown-toolbar-title fs-16 mb-0">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>
            <div class="dropdown-toolbar-actions">
                <a href="#" class="markAllAsRead fs-14">{{__('Mark all as read')}}</a>
            </div>
        </div>
        <div class="list-group">
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
        </div>
        <div class="dropdown-footer text-end mt-3 fs-14">
            <a class="btn btn-primary fs-14 c-white" href="{{route('user.notification')}}">{{__('View More')}}</a>
        </div>
    </ul>
</li>
