<div class="d-flex align-items-center border p-3 rounded mb-3">
    <div class="flex-shrink-0 me-3 circle w-75px h-75px">
        <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover w-75px h-75px">
    </div>
    <div class="flex-grow-1">
        <strong>{{$user->display_name}}</strong>
        <p class="mb-0"><a href="mailto:{{ $user->email }}">{{$user->email}}</a></p>
        <p class="mb-0">{{ __("Member Since :time",["time"=> date("M Y",strtotime($user->created_at))]) }}</p>
    </div>
</div>
@include("product.sidebar")