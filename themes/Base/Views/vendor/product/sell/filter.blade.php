<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
?>
<div class="bc-section__header py-3">
    <div class="bc-section__filter">
        <form class="bc-form--filter d-flex justify-content-between" action="" method="get">
            <div class="bc-form__left d-flex">
                <div class="me-3">
                    <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search product")}}" />
                </div>
                <div class="me-3">
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
                @if(empty($hide_status))
                <div class="me-3">
                    <select class="form-select" name="status">
                        <option value="">{{__('-- Status --')}}</option>
                        <option @if(request('status') == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                        <option @if(request('status') == 'pending') selected @endif value="pending">{{__("Pending")}}</option>
                        <option @if(request('status') == 'draft') selected @endif value="draft">{{__("Draft")}}</option>
                    </select>
                </div>
                @endif
                <div>
                    <button class="btn btn-default" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Filter')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
