@if(is_default_lang())
    @if(count($attributes))
        @foreach ($attributes as $attribute)
            <div class="form-group mb-3">
                <label class="control-label mb-2" >{{$attribute->name}}</label>
                <div class="controls">
                    <label class="block mb-3" data-condition="product_type:is(variable)"><input type="checkbox" name="attributes_for_variation[]" @if(!empty($product->attributes_for_variation) and in_array($attribute->id,$product->attributes_for_variation)) checked @endif value="{{$attribute->id}}"> {{__("Used for variations")}}</label>
                    <div class="">
                        @php $options = ["width"=>"100%","placeholder"=>__("-- Please select --")]; @endphp
                        <select data-options='{!! json_encode($options) !!}' name="terms[]" class="bc-select2" multiple>
                            @foreach($attribute->terms as $term)
                                <option value="{{$term->id}}"  @if(!empty($selected_terms) and $selected_terms->contains($term->id)) selected @endif>{{$term->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3 mt-3 ajax-add-term flex" data-attr-id="{{$attribute->id}}">
                        <input type="text" class="form-control grow !rounded-r-none" placeholder="{{$attribute->name}}" >
                        <div class="input-group-append shrink-0">
                            <button class="!rounded-l-none h-full btn btn-info bg-blue-700 hover:bg-blue-800 focus:ring-blue-500 text-white" type="button" ><i class="fa fa-plus"></i> {{__('Add :name',['name'=>$attribute->name])}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="@if(!empty($tailwind)) block mt-5 pb-4 @endif">
        @endforeach
        <div>
            <a href="#" class="btn btn-primary btn-save-attributes bg-amber-300 hover:bg-amber-400 focus:ring-4 focus:ring-amber-300"><i class="fa fa-save"></i> {{__('Save attributes')}}</a>
        </div>
    @else
        <div class="alert alert-warning">
            <div>{!!__('No attribute found. You can :link here',['link'=>'<a href="'.route('product.admin.attribute.index').'" >'.__('add attribute').'</a>'])!!}</div>
        </div>
    @endif
@endif
