<aside class="ps-widget--account-dashboard">
    <div class="ps-widget__header"><img src="{{$user->avatar_url}}" alt="{{$user->display_name}}">
        <figure>
            <figcaption>{{$user->display_name}}</figcaption>
            <p><a href="#">{{$user->email}}</a></p>
        </figure>
    </div>
    <div class="ps-widget__content">
        <ul>
            <li><a href="#"><i class="icon-user"></i> Account Information</a></li>
            <li><a href="#"><i class="icon-alarm-ringing"></i> Notifications</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.order.index','user.order.detail'])) active @endif"><a href="{{route('user.order.index')}}"><i class="icon-papers"></i> {{__('Orders')}}</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.address.index','user.address.detail'])) active @endif"><a href="{{route('user.address.index')}}"><i class="icon-map-marker"></i> {{__('Address')}}</a></li>
            <li><a href="#"><i class="icon-store"></i> Recent Viewed Product</a></li>
            <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="icon-power-switch"></i>{{__('Logout')}}</a></li>
        </ul>
    </div>
</aside>
