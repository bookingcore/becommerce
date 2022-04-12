{{--Axtronic promotions--}}
<div class="axtronic-promotions pb-5">
    <div class="container">
        <div class="mb-4">
            <h3 class="fs-24 mb-1">{{ $title }}</h3>
            <span class="fs-16">{{ $sub_title }}</span>
        </div>
        <div class="row">
            @foreach($list_items as $key => $item)
                @if($col == 'grid')
                    @php
                        switch ($key){
                            case '2': $colClass = "col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            case '3': $colClass = "col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            default: $colClass = "col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mb-lg-0 mb-4";
                        }
                    @endphp
                    <div class="{{ $colClass }}">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                            <div class="item-content d-flex flex-column {{ $item['class_content'] ?? '' }}">
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
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                            <div class="item-content d-flex flex-column {{ $item['class_content'] ?? '' }}">
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

