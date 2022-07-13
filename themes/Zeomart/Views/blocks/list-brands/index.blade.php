<div class="zm-list-brands  py-10">
    <div class="container">
        <div class="text-center text-base pb-8">
            {{ $title }}
        </div>
        <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
            @foreach($list_items as $key => $item)
                <div class="flex justify-center">
                    <img class="!w-auto" src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                </div>
            @endforeach
        </div>
    </div>
</div>
