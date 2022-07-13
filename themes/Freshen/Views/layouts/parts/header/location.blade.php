@php
    if(!setting_item('location_in_header')) return;
    $locations = \Modules\Location\Models\Location::query()->where('status','publish')->get();
    $session = session('be_location',setting_item('location_default'));
@endphp
@if(!empty($locations))
    <li class="list-inline-item">
        <div class="htlw_form_select">

            <span class="stts"><i class="fa fa-map-marker"></i> {{__("Store")}}</span>
            <select class="custom_select_dd bc-language-sw">
            @foreach($locations as $location)
                <option value="{{route('location.set',['location'=>$location])}}" @if($session == $location->id) selected @endif>
                    {{$location->name}}
                </option>
            @endforeach
            </select>
        </div>
    </li>
@endif
