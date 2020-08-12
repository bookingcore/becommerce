@if(is_default_lang())
    @if(count($attributes))
        @foreach ($attributes as $attribute)
            <div class="form-group">
                <label class="control-label" >{{$attribute->name}}</label>
                <div class="controls">
                    <label data-condition="product_type:is(variable)"><input type="checkbox" name="attributes_for_variation[]" @if(!empty($product->attributes_for_variation) and in_array($attribute->id,$product->attributes_for_variation)) checked @endif value="{{$attribute->id}}"> {{__("Used for variations")}}</label>
                    <div class="">
                        @php $options = ["width"=>"100%","placeholder"=>__("-- Please select --")]; @endphp
                        <select data-options='{!! json_encode($options) !!}' name="terms[]" class="dungdt-select2-field" multiple>
                            @foreach($attribute->terms as $term)
                                <option value="{{$term->id}}"  @if(!empty($selected_terms) and $selected_terms->contains($term->id)) selected @endif>{{$term->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3 mt-3 ajax-add-term" data-attr-id="{{$attribute->id}}">
                        <input type="text" class="form-control" placeholder="{{$attribute->name}}" >
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" ><i class="fa fa-plus"></i> {{__('Add :name',['name'=>$attribute->name])}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    @else
        <div class="alert alert-warning">
            <div>{!!__('No attribute found. You can :link here',['link'=>'<a href="'.route('product.admin.attribute.index').'" >'.__('add attribute').'</a>'])!!}</div>
        </div>
    @endif
@endif
