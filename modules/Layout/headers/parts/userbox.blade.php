<ul class="bravo-extra-menu">
    <li  class="user-compare-list">
        <a class="counter-wrap">
            <i class="icon-chart-bars extra-icon"></i>
            <span class="counter user-compare-count">{{ (session('compare')) ? count(session('compare')) : 0 }}</span>
        </a>
    </li>
    <li  class="user-wishlist">
        @if(Auth::user())
            <a class="counter-wrap" href="{{route('user.wishList.index')}}">
                <i class="icon-heart extra-icon"></i>
                <span class="counter user-wish-list-count">{{ count(wishlist()) }}</span>
            </a>
        @else
            <a href="#login" data-toggle="modal" class="counter-wrap" data-target="#login">
                <i class="icon-heart extra-icon"></i>
                <span class="counter user-wish-list-count">0</span>
            </a>
        @endif
    </li>
    <li  class="user-mini-cart">
        <a href="{{route('booking.cart')}}" class="counter-wrap">
            <i class="icon-bag2 extra-icon"></i>
            <span class="counter user-cart-count">{{Cart::count()}}</span>
        </a>
        <div class="cart-content" aria-labelledby="cart_dropdown">
            @include('Booking::frontend.cart.mini-cart')
        </div>
    </li>
    <li class="menu-user @if(Auth::user()) logged-in @else no-logged-in @endif">
        @if(!Auth::user())
            <div class="u-left" onclick="window.open(bookingCore.routes.login,'_self')">
                <i class="extra-icon icon-user"></i>
            </div>
            <div class="u-right">
                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Register')}}</a>
            </div>
        @else
            <div class="u-left">
                @if($avatar_url = Auth::user()->getAvatarUrl())
                    <div class="avatar"><img src="{{$avatar_url}}" alt="{{Auth::user()->getDisplayName()}}"></div>
                @else
                    <span class="avatar-text">{{ucfirst(Auth::user()->getDisplayName()[0])}}</span>
                @endif
            </div>
            <div class="u-right">
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :name",['name'=>Auth::user()->first_name])}}
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu text-left">
                        @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                            <li><a href="{{url(app_get_locale().'/user/dashboard')}}"><i class="fa fa-line-chart"></i> {{__("Vendor Dashboard")}}</a></li>
                        @endif
                        <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                            <a href="{{url(app_get_locale().'/user/profile')}}"><i class="fa fa-user"></i> {{__("My profile")}}</a>
                        </li>
                        <li class="menu-hr"><a href="{{route('user.orders.index')}}"><i class="fa fa-clock-o"></i> {{__("Order History")}}</a></li>
                        <li class="menu-hr"><a href="{{url(app_get_locale().'/user/profile/change-password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                        @if(Auth::user()->hasPermissionTo('dashboard_access'))
                            <li class="menu-hr"><a href="{{url('/admin')}}"><i class="fa fa-tachometer"></i> {{__("Admin Dashboard")}}</a></li>
                        @endif
                        <li class="menu-hr">
                            <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                        </li>
                    </ul>
                    <form id="logout-form-topbar" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        @endif
    </li>
</ul>
