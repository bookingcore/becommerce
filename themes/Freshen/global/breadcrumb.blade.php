@if(!empty($breadcrumbs))
    <div class="inner_page_breadcrumb pt50 pb50 mt50-992">
        <div class="container">
            <div class="breadcrumb_content mt15">
                <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>

                    @foreach($breadcrumbs as $item)
                        <?php if(empty($item['name'])) continue; ?>
                        <li class="breadcrumb-item @if(empty($item['url'])) active @endif" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            @if(!empty($item['url']))
                                <a itemprop="item" href="{{$item['url']}}"><span itemprop="name">{{$item['name']}}</span></a>
                            @else
                                <a itemprop="name">{{$item['name']}}</a>
                            @endif
                        </li>
                    @endforeach

                </ol>
            </div>
        </div>
    </div>
@endif

