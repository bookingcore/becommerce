<aside class="bc-widget--account-dashboard">
    <div class="d-flex align-items-center border p-3">
        <div class="flex-shrink-0 me-3 circle w-90px h-90px">
            <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover w-90px h-90px">
        </div>
        <figure class="flex-grow-1">
            <figcaption>{{$user->display_name}}</figcaption>
            <p><a href="#">{{$user->email}}</a></p>
        </figure>
    </div>
    <div class="bc-widget__content py-3">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.profile'])) active @endif" href="{{route('user.profile')}}"><i class="icon-user"></i> {{__('Account Information')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.notification'])) active @endif" href="{{route('user.notification')}}"><i class="icon-alarm-ringing"></i> {{__('Notifications')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.order.index','user.order.detail'])) active @endif" href="{{route('user.order.index')}}"><i class="icon-papers"></i> {{__('Orders')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.address.index','user.address.detail'])) active @endif" href="{{route('user.address.index')}}"><i class="icon-map-marker"></i> {{__('Address')}}</a></li>
            <li class="nav-item "><a class="nav-link" href="#"><i class="icon-heart"></i> Wishlist</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.password'])) active @endif" href="{{route('user.password')}}"><i class="icon-lock"></i> {{__('Change Password')}}</a></li>
            <li class="nav-item "><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="nav-link" class="icon-power-switch"></i>{{__('Logout')}}</a></li>
        </ul>
    </div>
</aside>
