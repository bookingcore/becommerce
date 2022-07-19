<div class="grid gap-4 grid-cols-12 pt-3">
    <div class="col-md-6 col-span-8">
        <div class="d-flex flex gap-4 items-center">
            <div class="zm-dropdown relative inline-block text-left">
                <div>
                    <button type="button" data-dropdown-toggle="product-price-dropdown" class="bg-[#F3F5F6] be-dropdown-toggle inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                        {{ __("Price") }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div id="product-price-dropdown" class="absolute z-10 min-w-[200px] p-5 text-sm bg-white border border-gray-100 rounded-b shadow-md group-hover:block hidden">
                    <div class="py-1" role="none">
                        <a href="#" class="bg-gray-100 text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                    </div>
                </div>
            </div>
            <div class="zm-dropdown relative inline-block text-left">
                <div>
                    <button type="button" class="bg-[#F3F5F6] be-dropdown-toggle inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                        {{ __("Brand") }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="zm-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1" role="none">
                        <a href="#" class="bg-gray-100 text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>

                    </div>
                </div>
            </div>
            <div class="zm-dropdown relative inline-block text-left">
                <div>
                    <button type="button" class="bg-[#F3F5F6] zm-dropdown-toggle inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                        {{ __("Color") }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="zm-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1" role="none">
                        <a href="#" class="bg-gray-100 text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-span-4">
        <div class="d-flex flex gap-4 items-center">
            <div class="bc-shopping__actions me-3 grow text-right">
                <div class="zm-dropdown relative inline-block text-left">
                    <a class=" block py-2 pl-3 pr-4 pt-4 pb-4  flex items-center justify-between w-full py-2 pl-3 pr-4 pt-4 pb-4 font-medium " data-dropdown-toggle="sort-dropdown" data-dropdown-placement="bottom-start">{{ __("Default Sort") }}
                        <svg aria-hidden="true" class="w-5 h-5 ml-1 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <div id="sort-dropdown" class="z-10 zm-dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1" role="none">
                            <a href="#" class="bg-gray-100 text-gray-900 block px-4 py-2 text-sm">Account settings</a>
                            <a href="#" class="text-gray-700 block px-4 py-2 text-sm">License</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="me-3 border-slate-500">
                <a href="{{request()->fullUrlWithQuery(['list_style'=>'list'])}}" class="border-slate-200 border-l p-1 {{$listing_list_style =='list'?'border-b':''}}">List</a>
                <a href="{{request()->fullUrlWithQuery(['list_style'=>''])}}" class="border-slate-200 border-l p-1 {{$listing_list_style ==''?'border-b':''}}">Grid</a>
            </div>
        </div>
    </div>
</div>
