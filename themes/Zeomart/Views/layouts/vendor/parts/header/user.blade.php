<li class=" group be-dropdown relative">
    <a href="#" data-bs-toggle="dropdown" class="be-dropdown-toggle login nav-link text-white">
        <div class="w-[50px] h-[50px] overflow-hidden rounded-[16px]">
            <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="">
        </div>
    </a>
    <div class="be-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y">
        <div class="py-1" role="none">
            <div class="d-block">
                <a class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{url(app_get_locale().'/user/profile')}}"><i class="fa fa-user"></i> {{__("My profile")}}</a>
            </div>
            <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('user.order.index')}}"><i class="fa fa-clock-o"></i> {{__("Order History")}}</a></div>
            <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('user.password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></div>
        </div>
        <div class="py-1" role="none">
            @if(is_vendor_enable() and is_vendor())
                <div><h6 class="dropdown-header block px-4 py-2 text-base font-medium">{{__("Store Settings")}}</h6></div>
                <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.dashboard')}}"><i class="fa fa-desktop"></i> {{__("Dashboard")}}</a></div>
                <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.product')}}"><i class="fa fa-database"></i> {{__("Products")}}</a></div>
                <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.order')}}"><i class="fa fa-shopping-basket"></i> {{__("Orders")}}</a></div>
                <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.payout')}}"><i class="fa fa-credit-card"></i> {{__("Payouts")}}</a></div>
                <div class=""><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{route('vendor.review')}}"><i class="fa fa-commenting"></i> {{__("Reviews")}}</a></div>
            @endif
        </div>
        <div class="py-1" role="none">
            @if(Auth::user()->hasPermission('setting_update'))
                <div class="menu-hr"><a class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" href="{{url('/admin')}}"><i class="fa fa-tachometer"></i> {{__("Admin Dashboard")}}</a></div>
            @endif
            <div class="menu-hr">
                <a  href="#" class=" text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"  onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
            </div>
        </div>
    </div>
    <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
