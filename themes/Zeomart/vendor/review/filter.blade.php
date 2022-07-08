<div class="bc-section__header py-3">
    <div class="bc-section__filter">
        <form class="bc-form--filter gap-4 flex justify-between" action="" method="get">
            <div class="grow">
                <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search by title")}}" />
            </div>
            <div class="shrink-0">
                <button class="inline-flex p-4 py-2 rounded items-center border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    {{__('Filter')}}
                </button>
            </div>
        </form>
    </div>
</div>
