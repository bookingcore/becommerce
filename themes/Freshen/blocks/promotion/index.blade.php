@if(!empty($list_items))
    <div class="bc-promotions mt70">
        <div class="container">
            <div class="row">
                @foreach($list_items as $key => $item)
                    <div class="{{ $key == 0 ? "col-lg-8 col-xl-6" : "col-lg-4 col-xl-3" }}">
                        <div class="banner_one">
                            <div class="thumb">
                                <img src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="details {{ $key == 0 ? "style1" : "style2" }}">
                                <p class="para">{!! $item['sub_title'] ?? '' !!}</p>
                                <h2 class="title">{!! $item['title'] ?? '' !!}</h2>
                                <a href="{{ $item['link'] ?? '' }}" class="shop_btn">{{ __("SHOP NOW") }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

