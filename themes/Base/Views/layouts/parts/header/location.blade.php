@php
    if(!setting_item('location_in_header')) return;
    $locations = \Modules\Location\Models\Location::query()->where('status','publish')->get();
    $session = session('be_location',setting_item('location_default'));
@endphp
@if(!empty($locations))
    <li class="dropdown">
        @foreach($locations as $location)
            @if($session == $location->id)
                <a href="#" data-bs-toggle="dropdown" class="is_login nav-link text-white">
                    <i class="fa fa-map-marker"></i>
                    {{__("Store")}} : {{$location->name}}
                    <i class="fa fa-angle-down"></i>
                </a>
            @endif
        @endforeach
        <ul class="dropdown-menu text-left">
            @foreach($locations as $location)
                @if($session != $location->id)
                    <li>
                        <a href="{{route('location.set',['location'=>$location])}}" class="dropdown-item">
                            {{$location->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endif
