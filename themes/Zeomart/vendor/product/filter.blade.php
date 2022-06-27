<form  action="" method="get">
    <div class="bc-form__left flex items-center gap-4">
        <div class="grow">
            <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search product")}}" />
        </div>
        <div class="grow">
            <select class="form-select" name="product_type">
                <option value="">{{__("-- Product Type--")}}</option>
                @foreach(get_product_types() as $type_id=>$type)
                    <option @if($type_id == request('product_type')) selected @endif value="{{$type_id}}">{{$type::getTypeName()}}</option>
                @endforeach
            </select>
        </div>
        <div class="grow">
            <select class="form-select" name="status">
                <option value="">{{__('-- Status --')}}</option>
                <option @if(request('status') == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                <option @if(request('status') == 'pending') selected @endif value="pending">{{__("Pending")}}</option>
                <option @if(request('status') == 'draft') selected @endif value="draft">{{__("Draft")}}</option>
            </select>
        </div>
        <div class="shrink-0">
            <button class="btn border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                {{__('Filter')}}
            </button>
        </div>
    </div>
</form>
