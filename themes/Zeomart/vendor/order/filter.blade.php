<div class="bc-section__header">
    <form  action="" method="get">
        <div class="bc-form__left d-flex flex gap-4 justify-end">
            <div class="me-3 grow">
                <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search Product ID or Order ID")}}" />
            </div>
            <div class="me-3 grow">
                <select class="form-select" name="status">
                    <option value="">{{__('-- Status --')}}</option>
                    <option @if(request('status') == 'on_hold') selected @endif value="on_hold">{{__("On-Hold")}}</option>
                    <option @if(request('status') == 'processing') selected @endif value="processing">{{__('Processing')}}</option>
                    <option @if(request('status') == 'completed') selected @endif value="completed">{{__('Completed')}}</option>
                    <option @if(request('status') == 'failed') selected @endif value="failed">{{__('Failed')}}</option>
                    <option @if(request('status') == 'cancelled') selected @endif value="cancelled">{{__('Cancelled')}}</option>
                    <option @if(request('status') == 'refunded') selected @endif value="refunded">{{__('Refunded')}}</option>
                </select>
            </div>
            <div class="shrink-0">
                <button class="inline-flex p-4 py-2 rounded items-center border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    {{__('Filter')}}
                </button>
            </div>
        </div>
    </form>
</div>
