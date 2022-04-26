@php
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp
<div class="header_middle_advnc_search {{ isset($header_style) ? 'home'.$header_style : '' }}">
    <div class="search_form_wrapper">
        <div class="top-search">
            <form action="{{route('product.index')}}" method="get" class="form-search">
                <div class="row">
                    <div class="col-auto pr0">
                        <div class="actegory">
                            <select class="custom_select_dd" id="selectbox_alCategory">
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
                    </div>
                    <div class="col-auto pr0">
                        <div class="top-search">
                            <div class="form-search">
                                <div class="box-search pre_line">
                                    <input name="s" class="form_control" type="text" placeholder="{{ __("I'm shopping for...") }}" value="{{ request()->input("s") }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto p0">
                        <div class="advscrh_frm_btn text-end">
                            <button type="submit" class="btn search-btn home{{ $header_style ?? setting_item('freshen_header_style') }}"><span class="flaticon-search"></span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
