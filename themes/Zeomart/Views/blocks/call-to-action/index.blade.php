<div class="zm-call-to-action  py-10">
    <div class="container">
        <div class="relative">
            <div class="thumb">
                <img src="{{ get_file_url($image , "full") }}" alt="{{ $title }}">
            </div>
            <div class="absolute left-[40px] top-[50%] translate-y-[-50%]">
                <p class="text-5xl font-[500] mb-8">{!! $title !!}</p>
                <h2 class="text-base mb-10">{!! $desc !!}</h2>
                <a href="{{ $link_shop_now }}" class="focus:outline-none bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                    {{ $btn_shop_now }}
                </a>
            </div>
        </div>
    </div>
</div>
