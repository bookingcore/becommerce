<div class="ps-block--user-header">
    @if(!auth()->check())
        <div class="ps-block__left"><i class="icon-user"></i></div>
        <div class="ps-block__right">
            <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
            <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Register')}}</a>
        </div>
    @else
        <div class="ps-block__left">
            @if($avatar_url = Auth::user()->avatar_url)
                <div class="avatar"><img src="{{$avatar_url}}" alt="{{Auth::user()->display_name}}"></div>
            @else
                <span class="avatar-text">{{ucfirst(Auth::user()->display_name[0])}}</span>
            @endif
        </div>
        <div class="ps-block__right">
            <div class="ps-dropdown">
                <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :name",['name'=>Auth::user()->first_name])}}
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="ps-dropdown-menu text-left">
                    @if(Auth::user()->hasPermission('vendor_access'))
                        <li><a href="{{url(app_get_locale().'/user/dashboard')}}"><i class="fa fa-line-chart"></i> {{__("Vendor Dashboard")}}</a></li>
                    @endif
                    <li class="@if(Auth::user()->hasPermission('vendor_access')) menu-hr @endif">
                        <a href="{{url(app_get_locale().'/user/profile')}}"><i class="fa fa-user"></i> {{__("My profile")}}</a>
                    </li>
                    <li class="menu-hr"><a href="{{route('user.order.index')}}"><i class="fa fa-clock-o"></i> {{__("Order History")}}</a></li>
                    <li class="menu-hr"><a href="{{route('user.password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                    @if(Auth::user()->hasPermission('setting_update'))
                        <li class="menu-hr"><a href="{{url('/admin')}}"><i class="fa fa-tachometer"></i> {{__("Admin Dashboard")}}</a></li>
                    @endif
                    <li class="menu-hr">
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                    </li>
                </ul>
                <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        @endif
</div>

