@if(!empty($breadcrumbs))
    <div class="page-header page-header-page">
        <div class="page-breadcrumbs">
            <div class="container">
                <ul class="breadcrumbs">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a class="home" href="{{url(app_get_locale())}}" itemprop="item">
                            <span itemprop="name">{{ __("Home") }} </span>
                        </a>
                    </li>
                    <span class="sep">/</span>
                    @foreach($breadcrumbs as $k=>$breadcrumb)
                        <li class=" {{$breadcrumb['class'] ?? ''}}" itemprop="itemListElement" itemscope
                            itemtype="http://schema.org/ListItem">
                            @if(!empty($breadcrumb['url']))
                                <a itemprop="item" href="{{url($breadcrumb['url'])}}">
                                    <span itemprop="name">{{$breadcrumb['name']}}</span>
                                </a>
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
    </div>
@endif
