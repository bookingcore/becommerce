@if(!empty($sliders))
    <div class="ps-home-banner">
        <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
            @foreach($sliders as $slide)
                <div class="ps-banner--market-1" data-background="{{ get_file_url($slide['image']?? false,'full') }}">
                    <img src="{{ get_file_url($slide['image'] ?? false,'full') }}" alt="{!! clean($slide['title']) !!}">
                    <div class="ps-banner__content">
                        <h5>{{ $slide['sub_title'] }}</h5>
                        <h3>{!! clean($slide['title']) !!}</h3>
                        <p>{!! clean($slide['sub_text']) !!}</p>
                        <a class="ps-btn" href="{{ $slide['link_shop_now'] }}">{{ $slide['btn_shop_now'] }}</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif
