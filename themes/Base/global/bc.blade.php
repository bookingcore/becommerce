
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>
            @if(!empty($breadcrumbs))
                @foreach($breadcrumbs as $item)
                    <?php if(empty($item['name'])) continue; ?>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        @if(!empty($item['url']))
                            <a itemprop="item" href="{{$item['url']}}"><span itemprop="name">{{$item['name']}}</span></a>
                        @else
                            <span itemprop="name">{{$item['name']}}</span>
                        @endif
                    </li>
                @endforeach
            @endif

        </ul>
    </div>
</div>
