<div class="zm-banner-slider">
    @if(!empty($sliders))
        <div class="bc-carousel owl-theme" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
            @foreach($sliders as $slide)
                <div class="item relative" data-background="{{ get_file_url($slide['image']?? false,'full') }}">
                    <img class="img-fluid" src="{{ get_file_url($slide['image'] ?? false,'full') }}" alt="{{strip_tags($slide['title'])}}">
                    <div class="bc-banner-content absolute top-0 left-0 bottom-0 right-0 ">
                        <div class="flex items-center h-full m-auto max-w-7xl">
                            <div>
                                <h5 class="text-sm p-1 px-2 bg-[#86F1DF] inline rounded mb-1">{{ $slide['sub_title'] }}</h5>
                                <h3 class="text-5xl py-5 leading-tight">{!! clean($slide['title']) !!}</h3>
                                <p class="text-base pb-8">{!! clean($slide['sub_text']) !!}</p>
                                <a class="focus:outline-none bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" href="{{ $slide['link_shop_now'] }}">{{ $slide['btn_shop_now'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
