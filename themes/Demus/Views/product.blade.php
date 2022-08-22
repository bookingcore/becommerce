@extends("layouts.app")
@section('content')
    <div class="bc-breadcrumb" style="background-image: url('{{get_file_url(setting_item('product_image'),'full')}}')">
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
            <h1>{{ setting_item('product_page_search_title') }}</h1>
        </div>
    </div>

    <div class="bc-page--shop our-listing pt-100" id="shop-sidebar">
        <div class="container">
            @includeWhen(View::exists('product.layouts.'.$layout), 'product.layouts.'.$layout)
            @includeUnless(View::exists('product.layouts.'.$layout), 'product.layouts.left-sidebar')
        </div>

    </div>
@endsection

