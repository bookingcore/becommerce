@if ($paginator->hasPages())
    <div class="mbp_pagination">
        <ul class="page_navigation  flex justify-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item " aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link inline-flex items-center  min-w-[40px] justify-center block h-10 mr-2  text-sm font-medium disabled" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link inline-flex items-center min-w-[40px] justify-center block h-10 mr-2  text-sm font-medium rounded-full border border-gray-300 hover:border-gray-500" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                        <li class="page-item  disabled" aria-disabled="true"><span class="page-link inline-flex items-center min-w-[40px] justify-center block h-10 mr-2  text-sm font-medium rounded-full ">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item " aria-current="page"><span class="page-link inline-flex items-center min-w-[40px] justify-center block h-10 mr-2  text-sm font-medium rounded-full  bg-yellow-500 ">{{ $page }}</span></li>
                        @else
                            <li class="page-item "><a class="page-link inline-flex items-center min-w-[40px] justify-center block h-10 mr-2  text-sm font-medium rounded-full  hover:bg-gray-300 " href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link inline-flex items-center min-w-[40px] justify-center block h-10 mr-2 border text-sm font-medium rounded-full border border-gray-300 hover:border-gray-500" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-item inline-flex items-center min-w-[40px] justify-center block h-10  text-sm font-medium" aria-hidden="true">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
        <p class="text-sm text-gray-700 leading-5 text-center mt-5">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>
@endif
