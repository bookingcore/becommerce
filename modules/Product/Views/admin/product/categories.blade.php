@if(is_default_lang())
    <div class="form-group">
        <label class="control-label">{{__("Categories")}}</label>
        <div class="controls">
            <div class="terms-scrollable">
                @php
                    $categoriesArray   = $row->categories->pluck("id")->toArray();

                    $traverse = function ($categories, $prefix = '') use (&$traverse, $categoriesArray) {

                        foreach ($categories as $category) {
                            $selected = '';
                            if (in_array($category->id,$categoriesArray))
                                $selected = 'checked';
                            printf("<label class='term-item'><input type='checkbox' name='category_ids[]' value='%s' %s><span class='term-name'>%s</span></label>", $category->id, $selected, $prefix . ' ' . $category->name);
                            $traverse($category->children, $prefix . '-');
                        }
                    };
                    $traverse($categories);
                @endphp
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Tags")}}</label>
        <div class="controls">
            <div class="">
                <input type="text" data-role="tagsinput" autocomplete="off" value="" placeholder="{{ __('Enter tag')}}" name="tag" class="form-group tag-input">
                <br>
                <div class="show_tags">
                    @if(count($row->tags)>0)
                        @foreach($row->tags as $tag)
                            <span class="tag_item">{{$tag->name}}<span data-role="remove"></span>
                                <input type="hidden" name="tag_ids[]" value="{{$tag->id}}">
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Brand")}}</label>
        <div class="controls">
            @php
                $brand = !empty($row->brand_id) ? \Modules\Product\Models\ProductBrand::find($row->brand_id) : false;
                \App\Helpers\AdminForm::select2('brand_id', [
                    'configs' => [
                        'ajax'        => [
                            'url' => route('product.admin.brand.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'allowClear'  => true,
                        'placeholder' => __('-- Select Brand --')
                    ]
                ], !empty($brand->id) ? [
                    $brand->id,
                    $brand->name . ' (#' . $brand->id . ')'
                ] : false)
            @endphp
        </div>
    </div>
@endif
