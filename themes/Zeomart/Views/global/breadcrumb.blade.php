@if(!empty($breadcrumbs))
    <!-- Breadcrumb -->
    <div class="container">
    <nav class="bc-breadcrumb flex px-5 py-3 " aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{url('/')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    {{__("Home")}}
                </a>
            </li>
            @foreach($breadcrumbs as $item)
                <?php if(empty($item['name'])) continue; ?>
                    <li>
                        <div class="flex items-center">
                            /
                            @if(!empty($item['url']))
                                <a href="{{$item['url']}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{$item['name']}}</a>
                            @else
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{$item['name']}}</span>
                            @endif
                        </div>
                    </li>
            @endforeach
        </ol>
    </nav>
    </div>
@endif

