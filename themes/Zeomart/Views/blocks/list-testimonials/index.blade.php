<div class="zm-block--testimonials md:py-20 py-10 bg-[#f9f8f7]">
    <div class="container">
        @if($title)
        <h2 class="text-base text-center md:mb-20 mb-10">{{ $title }}</h2>
        @endif
        @if($list_testimonials)
        <div class="zm-testimonials-carousel relative be-carousel owl-carousel"
             data-owl-item="1"
             data-owl-mousedrag="on"
             data-owl-nav="true"
             data-owl-nav-left='<svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.818725 8.00232L7.17851 14.3445C7.38688 14.5522 7.72424 14.5518 7.93226 14.3434C8.14012 14.1351 8.13958 13.7975 7.93118 13.5897L1.94995 7.62498L7.9314 1.6603C8.13977 1.45244 8.14031 1.11511 7.93247 0.906712C7.82819 0.802244 7.69158 0.75001 7.55497 0.75001C7.4187 0.75001 7.28263 0.801895 7.17854 0.905638L0.818725 7.24766C0.718366 7.34751 0.66205 7.4834 0.66205 7.62498C0.66205 7.76656 0.718527 7.90229 0.818725 8.00232Z" fill="#112137"/>
                                </svg>
                                '
             data-owl-nav-right='<svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.18128 7.24768L1.82149 0.90549C1.61312 0.697817 1.27576 0.698166 1.06774 0.906564C0.859882 1.11493 0.860419 1.45248 1.06882 1.66031L7.05005 7.62502L1.0686 13.5897C0.860231 13.7976 0.859694 14.1349 1.06753 14.3433C1.17181 14.4478 1.30842 14.5 1.44503 14.5C1.5813 14.5 1.71737 14.4481 1.82147 14.3444L8.18128 8.00234C8.28163 7.90249 8.33795 7.7666 8.33795 7.62502C8.33795 7.48344 8.28147 7.34771 8.18128 7.24768Z" fill="#112137"/>
                                </svg>
                                ' >
            @foreach($list_testimonials as $key => $val)
                <div class="test-item max-w-[920px] mx-auto text-center px-11">
                    <div class="inline-flex mx-auto gap-3 mb-7">
                        @for($i = 0; $i < ($val['stars'] ? (int)$val['stars'] : 5); $i++)
                            <span>
                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2484 5.47934C14.1543 5.19007 13.8977 4.98528 13.5954 4.95792L9.47151 4.58353L7.84173 0.767899C7.7214 0.487569 7.44761 0.306641 7.14287 0.306641C6.83812 0.306641 6.56422 0.487569 6.44466 0.767899L4.81488 4.58353L0.690364 4.95792C0.388017 4.98582 0.131992 5.19062 0.0373857 5.47934C-0.0566754 5.76861 0.0301921 6.08589 0.25886 6.28643L3.37617 9.01987L2.45703 13.0681C2.38979 13.3657 2.50532 13.6735 2.7523 13.8521C2.88505 13.9485 3.04102 13.9967 3.19753 13.9967C3.33203 13.9967 3.46664 13.961 3.58686 13.889L7.14287 11.7628L10.6982 13.889C10.959 14.0449 11.287 14.0306 11.5334 13.8521C11.7804 13.6735 11.896 13.3657 11.8287 13.0681L10.9096 9.01987L14.0269 6.28643C14.2554 6.08589 14.3424 5.76926 14.2484 5.47934Z" fill="#041E42"/>
                                </svg>
                            </span>
                        @endfor
                    </div>
                    <div class="mb-7 md:text-[26px] text-lg font-medium leading-loose">
                        {{ $val['review'] }}
                    </div>
                    <p class="text-base font-medium mb-1">{{ $val['name'] }}</p>
                    <p class="text-base">{{ $val['position'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="owl-counter text-[18px] font-medium md:mt-20 mt-10 text-center"></div>
        @endif
    </div>
</div>
