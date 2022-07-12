@if(!empty($list_items))
    <section class="bc-promotions pt0 mt70 pb60">
        <div class="container">
            <div class="row">
                @foreach($list_items as $key => $item)
                    <div class="col-lg-6 ">
                        <div class="banner_one home3_style">
                            <div class="thumb style1">
                                <img src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="details">
                                <p class="para">{!! $item['sub_title'] ?? '' !!}</p>
                                <h2 class="title">{!! $item['title'] ?? '' !!}</h2>
                                <a href="{{ $item['link'] ?? '' }}" class="shop_btn">{{ __("SHOP NOW") }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

