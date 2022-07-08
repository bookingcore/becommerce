<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
?>
<form  action="" method="get">
    <div class="bc-form__left flex items-center gap-4">
        <div class="grow">
            <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search product")}}" />
        </div>
        <div class="grow">
            <select class="form-select" name="category_id">
                <option value="">{{__("-- Category--")}}</option>
                @php
                    $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse) {
                        foreach ($categories as $category) {
                            $translate = $category->translate(app()->getLocale());
                            $has_children = count($category->children);
                            $selected = '';
                            if($category->id == request('category_id')){
                                $selected = 'selected';
                            }
                            echo '<option '.$selected.' value='.$category->id.'>'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>'.PHP_EOL;
                            if($has_children){
                                $traverse($category->children, $prefix,$level + 1);
                            }
                        }
                    };
                    $traverse($categories,'&#8211;');
                @endphp
            </select>
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
            <button class="inline-flex p-4 py-2 rounded items-center border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                {{__('Filter')}}
            </button>
        </div>
    </div>
</form>
