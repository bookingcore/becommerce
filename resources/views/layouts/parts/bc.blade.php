@if(!empty($breadcrumbs))
<div class="blog-breadcrumb hidden-xs">
    <div class="bravo-container container">
        <ul>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="{{url(app_get_locale())}}"> <span itemprop="name">{{__('Home')}}</span></a>
                <span class="sep">/</span></li>
            @foreach($breadcrumbs as $k=>$breadcrumb)
                <li class=" {{$breadcrumb['class'] ?? ''}}" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    @if(!empty($breadcrumb['url']))
                        <a itemprop="item" href="{{url($breadcrumb['url'])}}"><span itemprop="name">{{$breadcrumb['name']}}</span></a>
                    @else
                        {{$breadcrumb['name']}}
                    @endif

                    @if($k < count($breadcrumbs) - 1)
                        <span class="sep">/</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif