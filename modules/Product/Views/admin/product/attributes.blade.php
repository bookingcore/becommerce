@if(is_default_lang())
<div class="panel">
    <div class="panel-title"><strong>{{__("Categories")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <div class="terms-scrollable">
                <?php
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
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__("Tags")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <div class="">
                <input type="text" data-role="tagsinput" autocomplete="off" value="" placeholder="{{ __('Enter tag')}}" name="tag" class="form-control tag-input">
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
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__("Brand")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            $brand = !empty($row->brand_id) ? ProductBrand::find($row->brand_id) : false;
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
            ?>
        </div>
    </div>
</div>
@foreach ($attributes as $attribute)
    <div class="panel">
        <div class="panel-title"><strong>{{__('Attribute: :name',['name'=>$attribute->name])}}</strong></div>
        <div class="panel-body">
            <div class="terms-scrollable">
                @foreach($attribute->terms as $term)
                    <label class="term-item">
                        <input @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                        <span class="term-name">{{$term->name}}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
@endif
