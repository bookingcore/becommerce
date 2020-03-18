@if(!empty($breadcrumbs))
    <ul class="breadcrumbs">
        <li><a href="{{ url("/") }}"> {{ __('Home')}}</a></li>
        <span class="sep">/</span>
        @foreach($breadcrumbs as $key => $breadcrumb)
            <li class="{{$breadcrumb['class'] ?? ''}}">
                @if(!empty($breadcrumb['url']))
                    <a style="color: #fcb800" href="{{url($breadcrumb['url'])}}">{{$breadcrumb['name']}}</a>
                @else
                    {{$breadcrumb['name']}}
                @endif
            </li>
            <span class="sep">/</span>
        @endforeach
    </ul>
@endif
