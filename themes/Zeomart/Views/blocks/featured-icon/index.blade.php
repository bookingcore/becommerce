@if(!empty($list_items))
    <div class="zm-icon-features py-10 border-t border-b pb-6">
        <div class="container">
            <div class="flex">
                @foreach($list_items as $item)
                    <div class="w-1/4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0 items-start mt-1">
                                <img class="img-fluid" src="{{ get_file_url($item['image'] ?? false,'full') }}" alt="{{strip_tags($item['title'])}}">
                            </div>
                            <div class="flex-grow-1 ml-4">
                                <h4 class="text-base font-[500] mb-2">{{ $item['title'] ?? '' }}</h4>
                                <p class="mb-0 color-[#626974]">{{$item['sub_title'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
