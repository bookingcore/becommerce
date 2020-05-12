@if(!empty($breadcrumbs))
    <div class="container">
        <ul class="breadcrumbs list-unstyled">
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
    </div>
@endif
