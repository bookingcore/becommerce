<li class="login-item dropdown">
    <a href="#" data-bs-toggle="dropdown" class="login nav-link text-white">{{__("Hi, :name",['name'=>Auth::user()->display_name])}}
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-user text-left dropdown-menu-end miw-250">
        <li class="">
            <a class="dropdown-item" href="{{url(app_get_locale().'/user/profile')}}"><i class="fa fa-user"></i> {{__("My profile")}}</a>
        </li>
        <li class="menu-hr"><a class="dropdown-item" href="{{route('user.order.index')}}"><i class="fa fa-clock-o"></i> {{__("Order History")}}</a></li>
        <li class="menu-hr"><a class="dropdown-item" href="{{route('user.password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>

        @if(is_vendor_enable() and is_vendor())
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">{{__("Store Settings")}}</h6></li>
            <li class=""><a class="dropdown-item" href="{{route('vendor.dashboard')}}"><i class="fa fa-desktop"></i> {{__("Dashboard")}}</a></li>
            <li class=""><a class="dropdown-item" href="{{route('vendor.product')}}"><i class="fa fa-database"></i> {{__("Products")}}</a></li>
            <li class=""><a class="dropdown-item" href="{{route('vendor.order')}}"><i class="fa fa-shopping-basket"></i> {{__("Orders")}}</a></li>
            <li class=""><a class="dropdown-item" href="{{route('vendor.payout')}}"><i class="fa fa-credit-card"></i> {{__("Payouts")}}</a></li>
            <li class=""><a class="dropdown-item" href="{{route('vendor.review')}}"><i class="fa fa-commenting"></i> {{__("Reviews")}}</a></li>
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
