@if(!empty($categoryTopSearchPage))
    <div class="shop_slider_col6">
        @foreach($categoryTopSearchPage as $category)
            @php($translate = $category->translate())
            <div class="item">
                <a href="{{$category->getDetailUrl()}}">
                    <div class="iconbox slider_style">
                        @if(!empty($category->image_id))
                        <?php
                            $img = get_file_url($category->image_id)
                        ;?>
                        <div class="icon"><img src="{{$img}}" alt="food-grocery.png"></div>
                        @endif
                        <div class="details">
                            <h5 class="title">{{$translate->title}}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
