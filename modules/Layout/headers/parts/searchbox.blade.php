<form class="bravo-main-search-box input-group" method="get" action="{{route('product.index')}}">
    <div class="input-group-prepend">
        <select name="category_id" class="category-select form-control">
            <option value="">{{__("All")}}</option>
            @php
                $category = \Modules\Product\Models\ProductCategory::getCachedTree();
            @endphp
            <?php
            $traverse = function ($categories, $prefix = '') use (&$traverse) {
                foreach ($categories as $category) {
                    $selected = '';
                    printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                    $traverse($category->children, $prefix . '-');
                }
            };
            $traverse($category);
            ?>
        </select>
        <select class="select_change" style="display: none">
            <option id="text_change"></option>
        </select>
    </div>
    <input type="text" name="s" value="{{strip_tags(request()->query('s'))}}" class="form-control" placeholder="{{__("I'm shopping for...")}}">
    <div class="input-group-append">
        <button class="btn">{{__('Search')}}</button>
    </div>
</form>
