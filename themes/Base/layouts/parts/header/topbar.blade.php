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
<div class="bravo_topbar bg-dark py-1">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="topbar-left  text-white d-flex">
                {!! clean(setting_item_with_lang("topbar_left_text")) !!}
            </div>
            <div class="topbar-right">
                <ul class="topbar-items nav">
                    @include('layouts.parts.header.currency-switcher')
                    @include('layouts.parts.header.language-switcher')
                    @if(!Auth::id())
                        <li class="login-item">
                            <a href="#login" data-bs-toggle="modal" data-target="#login" class="login nav-link text-white">{{__('Login')}}</a>
                        </li>
                        <li class="signup-item">
                            <a href="#register" data-bs-toggle="modal" data-target="#register" class="signup  nav-link  text-white">{{__('Sign Up')}}</a>
                        </li>
                    @else
                        <li class="dropdown-notifications dropdown p-0">
                            <a href="#" data-bs-toggle="dropdown" class="is_login nav-link text-white">
                                <i class="fa fa-bell mr-2"></i>
                                <span class="badge badge-danger notification-icon">{{$countUnread}}</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-right dropdown-large">
                                <div class="dropdown-toolbar">
                                    <div class="dropdown-toolbar-actions">
                                        <a href="#" class="markAllAsRead">{{__('Mark all as read')}}</a>
                                    </div>
                                    <h3 class="dropdown-toolbar-title">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>
                                </div>
                                <ul class="dropdown-list-items p-0">
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
                                            <li class="notification {{$active}}">
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
                                    @endif
                                </ul>
                                <div class="dropdown-footer text-center">
                                    <a href="{{route('core.notification.loadNotify')}}">{{__('View More')}}</a>
                                </div>
                            </ul>
                        </li>
                        <li class="login-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="login nav-link text-white">{{__("Hi, :name",['name'=>Auth::user()->display_name])}}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-user text-left">
                                <li class="">
                                    <a class="dropdown-item" href="{{url(app_get_locale().'/user/profile')}}"><i class="fa fa-user"></i> {{__("My profile")}}</a>
                                </li>
                                <li class="menu-hr"><a class="dropdown-item" href="{{route('user.order.index')}}"><i class="fa fa-clock-o"></i> {{__("Order History")}}</a></li>
                                <li class="menu-hr"><a class="dropdown-item" href="{{route('user.password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>

                                @if(is_vendor_enable() and Auth::user()->hasPermission('vendor_access'))
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">{{__("Vendor Settings")}}</h6></li>
                                    <li class=""><a class="dropdown-item" href="{{route('vendor.dashboard')}}"><i class="fa fa-line-chart"></i> {{__("Dashboard")}}</a></li>
                                    <li class=""><a class="dropdown-item" href="{{route('vendor.order')}}"><i class="fa fa-line-chart"></i> {{__("Orders")}}</a></li>
                                    <li class=""><a class="dropdown-item" href="{{route('vendor.product')}}"><i class="fa fa-line-chart"></i> {{__("Products")}}</a></li>
                                @endif
                                @if(Auth::user()->hasPermission('setting_update'))
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="menu-hr"><a class="dropdown-item" href="{{url('/admin')}}"><i class="fa fa-tachometer"></i> {{__("Admin Dashboard")}}</a></li>
                                @endif
                                    <li><hr class="dropdown-divider"></li>
                                <li class="menu-hr">
                                    <a  href="#" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                </li>
                            </ul>
                            <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
