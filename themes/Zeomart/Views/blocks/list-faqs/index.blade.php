<div class="zm-block--list-faqs">
    <div class="container">
        @if($title)
            <h2 class="text-[28px] text-center font-medium lg:mb-14 mb-10">{{ $title }}</h2>
        @endif
        @if($list_faqs)
        <div class="max-w-[924px] mx-auto pb-7">

            @foreach($list_faqs as $key => $val)
                <div class="faq-item @if($loop->first) active @endif">
                    <div class="faq-header flex items-center justify-between focus:outline-none cursor-pointer">
                        <h3 class="text-xl font-medium flex"><span class="text-[28px] w-[35px] mr-2 inline-flex">{{ $key < 9 ? '0' : '' }}{{ $key + 1 }}</span> {{ $val['question'] }}</h3>
                        <svg width="15" height="1" class="svg-line" viewBox="0 0 15 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="15" height="1" fill="#041E42"/>
                        </svg>
                        <svg width="15" height="15" class="svg-plus" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 7H15V8H0V7Z" fill="#041E42"/>
                            <path d="M7 15L7 4.37113e-08L8 0L8 15H7Z" fill="#041E42"/>
                        </svg>
                    </div>

                    <div class="flex mt-2 faq-content" @if(!$loop->first) style="display: none;" @else style="display: block;" @endif >
                        <div class="text-base">
                            {{ $val['answer'] }}
                        </div>
                    </div>
                </div>

                @if(!$loop->last)
                <hr class="my-8 border-gray-200 dark:border-gray-700">
                @endif
            @endforeach

        </div>
        @endif
    </div>
</div>
