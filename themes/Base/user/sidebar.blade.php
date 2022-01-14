<aside class="bc-widget--account-dashboard">
    <div class="d-flex align-items-center border p-3 rounded">
        <div class="flex-shrink-0 me-3 circle w-75px h-75px">
            <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover w-75px h-75px">
        </div>
        <div class="flex-grow-1">
            <strong>{{$user->display_name}}</strong>
            <p class="mb-0"><a href="mailto:{{ $user->email }}">{{$user->email}}</a></p>
            <p class="mb-0">{{ __("Member Since :time",["time"=> date("M Y",strtotime($user->created_at))]) }}</p>
        </div>
    </div>
    <div class="bc-widget__content py-3">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.profile'])) active @endif" href="{{route('user.profile')}}"><i class="fa fa-user"></i> {{__('Account Information')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.notification'])) active @endif" href="{{route('user.notification')}}"><i class="fa fa-life-ring"></i> {{__('Notifications')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.order.index','user.order.detail'])) active @endif" href="{{route('user.order.index')}}"><i class="fa fa-book"></i> {{__('Orders')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.address.index','user.address.detail'])) active @endif" href="{{route('user.address.index')}}"><i class="fa fa-address-book"></i> {{__('Address')}}</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.wishList.index'])) active @endif" href="{{route('user.wishList.index')}}"><i class="fa fa-heart"></i> Wishlist</a></li>
            <li class="nav-item "><a class="nav-link @if(in_array(request()->route()->getName(),['user.password'])) active @endif" href="{{route('user.password')}}"><i class="fa fa-lock"></i> {{__('Change Password')}}</a></li>
            <li class="nav-item "><a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i>{{__('Logout')}}</a></li>
        </ul>
    </div>
</aside>
