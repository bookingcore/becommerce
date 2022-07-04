@if ($paginator->hasPages())
    <div class="mbp_pagination">
        <ul class="page_navigation  flex justify-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item " aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link inline-flex items-center px-4 py-2 mr-2  text-sm font-medium disabled" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link inline-flex items-center px-4 py-2 mr-2  text-sm font-medium rounded-full border border-transparent hover:border-gray-500" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                        <li class="page-item  disabled" aria-disabled="true"><span class="page-link inline-flex items-center px-4 py-2 mr-2  text-sm font-medium rounded-full ">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item " aria-current="page"><span class="page-link inline-flex items-center px-4 py-2 mr-2  text-sm font-medium rounded-full  bg-yellow-500 ">{{ $page }}</span></li>
                        @else
                            <li class="page-item "><a class="page-link inline-flex items-center px-4 py-2 mr-2  text-sm font-medium rounded-full  hover:bg-gray-300 " href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link inline-flex items-center px-4 py-2 mr-2 border text-sm font-medium rounded-full border border-transparent hover:border-gray-500" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-item inline-flex items-center px-4 py-2  text-sm font-medium" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
