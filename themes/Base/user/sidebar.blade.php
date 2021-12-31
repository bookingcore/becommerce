<aside class="ps-widget--account-dashboard">
    <div class="ps-widget__header"><img src="{{$user->avatar_url}}" alt="{{$user->display_name}}">
        <figure>
            <figcaption>{{$user->display_name}}</figcaption>
            <p><a href="#">{{$user->email}}</a></p>
        </figure>
    </div>
    <div class="ps-widget__content">
        <ul>
            <li class="@if(in_array(request()->route()->getName(),['user.profile'])) active @endif"><a href="{{route('user.profile')}}"><i class="icon-user"></i> {{__('Account Information')}}</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.notification'])) active @endif"><a href="{{route('user.notification')}}"><i class="icon-alarm-ringing"></i> {{__('Notifications')}}</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.order.index','user.order.detail'])) active @endif"><a href="{{route('user.order.index')}}"><i class="icon-papers"></i> {{__('Orders')}}</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.address.index','user.address.detail'])) active @endif"><a href="{{route('user.address.index')}}"><i class="icon-map-marker"></i> {{__('Address')}}</a></li>
            <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
            <li class="@if(in_array(request()->route()->getName(),['user.password'])) active @endif"><a href="{{route('user.password')}}"><i class="icon-lock"></i> {{__('Change Password')}}</a></li>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="icon-power-switch"></i>{{__('Logout')}}</a></li>
        </ul>
    </div>
</aside>