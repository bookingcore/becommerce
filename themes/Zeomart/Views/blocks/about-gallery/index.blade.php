@if($list_items)
    <div class="zm-block-about-gallery mb-5 lg:mb-7 pt-2.5">
        <div class="container mx-auto">
            <div class="flex flex-wrap -ml-2.5 -mr-2.5 lg:-ml-3.5 lg:-mr-3.5">
                <div class="w-1/2 md:w-1/4 pl-2.5 pr-2.5 lg:pl-3.5 lg:pr-3.5">
                    @php $i = 0; @endphp
                    @foreach($list_items as $key => $val)
                        @php $i++; @endphp
                        <div class="about-gallery-item mb-5 lg:mb-7">
                            <img src="{{ get_file_url($val['image'] ?? '', 'full') }}" class="rounded-lg w-full" alt="" />
                        </div>
                        @if(($i == 1 || $i == 3))
                            </div>
                            <div class="w-1/2 md:w-1/4 pl-2.5 pr-2.5 lg:pl-3.5 lg:pr-3.5">
                        @endif
                        @if($i == 3)
                            @php $i = 0; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
