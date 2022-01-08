
<div class="bc-breadcrumb my-3">
    <div class="container bg-light py-3 ">
        <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>
            @if(!empty($breadcrumbs))
                @foreach($breadcrumbs as $item)
                    <?php if(empty($item['name'])) continue; ?>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        @if(!empty($item['url']))
                            <a itemprop="item" href="{{$item['url']}}"><span itemprop="name">{{$item['name']}}</span></a>
                        @else
                            <span itemprop="name">{{$item['name']}}</span>
                        @endif
                    </li>
                @endforeach
            @endif

        </ol>
    </div>
</div>
