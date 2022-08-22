
<div class="bc-breadcrumb">
    <div class="container">
        @if(!empty($breadcrumbs))
            <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>
                @foreach($breadcrumbs as $item)
                    <?php if(empty($item['name'])) ?>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        @if(!empty($item['url']))
                            <a itemprop="item" href="{{$item['url']}}"><span itemprop="name">{{$item['name']}}</span></a>
                        @else
                            <span itemprop="name">{{$item['name']}}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        @endif
            <h1>{{$translation->title}}</h1>
    </div>
</div>
