<!-- Top Category -->
<section class="top-category pb60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shop_item_8grid_slider nav_none dots_none">
                    @foreach($list_items as $k=>$item)
                        @php $image_url = get_file_url($item['image_id'] ?? "", 'full'); @endphp
                        @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                            @php
                                $translate = $item_cat->translate(app()->getLocale());
                                $page_search = $item_cat->getDetailUrl();
                            @endphp
                            <div class="item">
                                <a href="{{ $page_search }}">
                                    <div class="iconbox">
                                        <div class="icon">
                                            <img src="{{$image_url}}" alt="{{ $translate->name }}">
                                        </div>
                                        <div class="details">
                                            <h5 class="title">{{ $translate->name }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>