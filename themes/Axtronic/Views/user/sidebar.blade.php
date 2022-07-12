<aside class="axtronic-widget--account-dashboard">
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
    <div class="axtronic-widget__content py-3">
        <div  class="list-group">
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.profile'])) active @endif" href="{{route('user.profile')}}"><i class="axtronic-icon-user"></i> {{__('Account Information')}}</a>
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.notification'])) active @endif" href="{{route('user.notification')}}"><i class="axtronic-icon-envelope"></i> {{__('Notifications')}}</a>
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.order.index','user.order.detail'])) active @endif" href="{{route('user.order.index')}}"><i class="axtronic-icon-shopping-cart"></i> {{__('Orders')}}</a>
            @if(!setting_item('product_disable_downloadable'))
                <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.download.index'])) active @endif" href="{{route('user.download.index')}}"><i class="fa fa-download"></i> {{__('Downloads')}}</a>
            @endif
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.address.index','user.address.detail'])) active @endif" href="{{route('user.address.index')}}"><i class="axtronic-icon-map-marker-check"></i> {{__('Address')}}</a>
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.wishList.index'])) active @endif" href="{{route('user.wishList.index')}}"><i class="axtronic-icon-heart"></i> Wishlist</a>
            <a class="list-group-item list-group-item-action @if(in_array(request()->route()->getName(),['user.password'])) active @endif" href="{{route('user.password')}}"><i class="axtronic-icon-tag"></i> {{__('Change Password')}}</a>
            <a class="list-group-item list-group-item-action" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="axtronic-icon-sign-out-alt"></i>{{__('Logout')}}</a>
        </div>
    </div>
</aside>
