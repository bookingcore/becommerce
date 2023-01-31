@php
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp
<div class="search_form_wrapper">
    @if(get_search_engine())
        <div id="bc_autocomplete" data-placeholder="{{__("I'm shopping for...")}}"></div>
    @else
        <form action="{{route('product.index')}}" method="get" class="form-search bg-[#F5F8FA] rounded-full overflow-hidden ">
            <div class="flex">
                <div class="w-3/5">
                    <input name="s" class="w-full border-0 bg-transparent padding pl-8 pr-5 py-3 text-sm !shadow-transparent" type="text" placeholder="{{ __("Search products ...") }}" value="{{ request()->input("s") }}">
                </div>
                <div class="w-2/5 flex items-center justify-end">
                    <div class="line w-px h-3/5 bg-slate-300 mt-1 mb-1"></div>
                    <div class="category ml-2">
                        <select name="cat_slug" class="border-0 bg-transparent bg-[length:18px_18px] text-sm">
                            <option value="">{{__("All Category")}}</option>
                            @php
                                $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                                    foreach ($categories as $category) {
                                        $translate = $category->translate(app()->getLocale());
                                        $has_children = count($category->children);
                                        $selected = '';
                                        if((isset($current_cat) and $category->id == $current_cat->id)){
                                            $selected = 'selected';
                                        }
                                        echo '<option '.$selected.' value='.$category->slug.'>'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>'.PHP_EOL;
                                        if($has_children){
                                            $traverse($category->children, $prefix,$level + 1);
                                        }
                                    }
                                };
                                $traverse($categories,'&#8211;');
                            @endphp
                        </select>
                    </div>
                    <div class="ml-2 flex items-center mr-5">
                        <button type="submit" class="btn search-btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.11605 0.609421C3.98379 0.609421 0.617676 3.97552 0.617676 8.10781C0.617676 12.2401 3.98379 15.6127 8.11605 15.6127C9.88107 15.6127 11.5043 14.9942 12.7873 13.9672L15.9107 17.0889C16.0683 17.24 16.2788 17.3234 16.4971 17.3211C16.7155 17.3189 16.9242 17.2313 17.0787 17.077C17.2332 16.9227 17.3212 16.7141 17.3237 16.4958C17.3262 16.2774 17.2432 16.0668 17.0923 15.909L13.9689 12.7856C14.9968 11.5007 15.6161 9.87486 15.6161 8.10781C15.6161 3.97552 12.2483 0.609421 8.11605 0.609421ZM8.11605 2.27611C11.3476 2.27611 13.9478 4.87628 13.9478 8.10781C13.9478 11.3393 11.3476 13.946 8.11605 13.946C4.88452 13.946 2.28434 11.3393 2.28434 8.10781C2.28434 4.87628 4.88452 2.27611 8.11605 2.27611Z" fill="#041E42"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
