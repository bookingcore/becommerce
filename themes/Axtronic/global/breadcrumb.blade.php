@if(!empty($breadcrumbs))
    <div class="bc-breadcrumb mb-3 bg-light">
        <div class="container">
            <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>

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

            </ol>
        </div>
    </div>
@endif

