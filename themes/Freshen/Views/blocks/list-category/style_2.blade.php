<section class="our-shops pt70 pb70">
    <div class="container">
        <div class="main-title mb20">
            <div class="row">
                <div class="col-sm-9 col-lg-9 col-xl-6">
                    <h2>{{ $title }}</h2>
                </div>
                @if(!empty($btn_url))
                <div class="col-sm-3 col-lg-3 col-xl-6">
                    <a class="title_more_btn thm3 text-thm3 float-end mt10 fn-520" href="{{ $btn_url }}">{{ $btn_name }}</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if(!empty($list_items_2))
               @foreach($list_items_2 as $list_item)
                    @php $image_url = get_file_url($list_item['image_id'] ?? "", 'full'); @endphp
                    <div class="col-md-6 col-xl-4">
                        <div class="category_list_box">
                            <h5 class="title">{{ $list_item['title'] }}</h5>
                            <ul class="mb20">
                                @foreach($list_item['categories'] as $cate)
                                    @php
                                        $translate = $cate->translate(app()->getLocale());
                                        $page_search = $cate->getDetailUrl();
                                    @endphp
                                    <li><a href="{{ $page_search }}">{{ $translate->name }}</a></li>
                                @endforeach
                            </ul>
                            @if(!empty($list_item['btn_url']))
                                <a class="shop_btn thm3 text-thm3" href="{{ $list_item['btn_url'] }}">{{ $list_item['btn_name'] }}</a>
                            @endif
                            <div class="thumb"><img src="{{ $image_url }}" alt="{{ $list_item['title'] }}"></div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
