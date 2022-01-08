@if(!empty($brands))
    @php
        $selected = (array) Request::query('brand');
    @endphp
    <h4 class="widget-title">{{__("BY BRANDS")}}</h4>
    <figure class="bc-custom-scrollbar pt-0">
        @foreach($brands as $item=>$brand)
            @php $translate = $brand->translate(app()->getLocale()) @endphp
            <div class="bc-checkbox">
                <input @if(in_array($brand->id,$selected)) checked @endif type="checkbox" id="brand_{{$brand->id}}" name="brand[]" value="{{$brand->id}}">
                <label for="brand_{{$brand->id}}">
                    {{ $translate->name }}
                </label>
            </div>
        @endforeach
    </figure>
@endif
