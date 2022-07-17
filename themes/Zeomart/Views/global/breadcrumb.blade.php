@if(!empty($breadcrumbs))
    <!-- Breadcrumb -->
    <nav class="bc-breadcrumb flex py-5" aria-label="Breadcrumb">
        <div class="container">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{url('/')}}" class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        {{__("Home")}}
                    </a>
                </li>
                @foreach($breadcrumbs as $item)
                    @if(empty($item['name'])) @continue; @endif
                    <li>
                        <div class="flex items-center">
                            /
                            @if(!empty($item['url']))
                                <a href="{{$item['url']}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{$item['name']}}</a>
                            @else
                                <span class="ml-1 text-sm text-gray-500 md:ml-2 dark:text-gray-400">{{$item['name']}}</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </nav>
@endif

