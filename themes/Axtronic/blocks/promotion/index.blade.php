{{--Axtronic promotions--}}
<div class="axtronic-promotions">
    <div class="container">
        @if($title)
            <h3 class="mb-1">{{ $title }}</h3>
        @endif
        @if($sub_title)
            <p class="mb-4">{{ $sub_title }}</p>
        @endif
        <div class="row mt-4">
            @foreach($list_items as $key => $item)
                @php
                    switch ($item['position']){
                        case 'top_right': $classPosition = "align-items-end justify-content-start"; break;
                        case 'bottom_left': $classPosition = "align-items-start justify-content-end"; break;
                        case 'bottom_right': $classPosition = "align-items-end justify-content-end"; break;
                        case 'center_right': $classPosition = "align-items-end justify-content-center"; break;
                        case 'center_left': $classPosition = "align-items-start justify-content-center"; break;
                        default: $classPosition = "align-items-start justify-content-start";
                    }
                @endphp
                @if($col == 'grid')
                    @php
                        switch ($key){
                            case '2': $colClass = "col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            case '3': $colClass = "col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            default: $colClass = "col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mb-lg-0 mb-4";
                        }
                    @endphp
                    <div class="{{ $colClass }}">
                        <div class="promotions-item {{ $item['style_color']}}">
                            <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                            <div class="item-content d-flex flex-column {{ $classPosition }}">
                                <span class="sub-title">{{ $item['title'] ?? '' }}</span>
                                <h3>{{ $item['title'] ?? '' }}</h3>
                                <p>
                                    {!! $item['content'] ?? '' !!}
                                </p>
                                <a href="{{ $item['link'] ?? '' }}" class="item-button">{{ __('Shop Now') }} <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                @else
                    @php
                        switch ($col){
                            case '4': $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            case '3': $colClass = "col-xl-$col col-lg-$col col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            default: $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4";
                        }
                    @endphp
                    <div class="{{ $colClass }} mb-xl-0 mb-4">
                        <div class="promotions-item {{ $item['style_color']}}">
                            <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                            <div class="item-content d-flex flex-column {{ $classPosition }}">
                                <span class="sub-title">{{ $item['title'] ?? '' }}</span>
                                <h3>{{ $item['title'] ?? '' }}</h3>
                                <p>
                                    {!! $item['content'] ?? '' !!}
                                </p>
                                <a href="{{ $item['link'] ?? '' }}" class="item-button">{{ __('Shop Now') }} <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

