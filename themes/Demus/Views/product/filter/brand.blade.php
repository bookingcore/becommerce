@if(!empty($brands))
    @php
        $selected = (array) Request::query('brand');
    @endphp
        <h6 class="widget_title">{{__($widget['title'])}}</h6>
        <div class="bc-checkbox-brands">
            @foreach($brands as $item=>$brand)
                @php $translate = $brand->translate(app()->getLocale()) @endphp
                <div class="bc-checkbox">
                    <input @if(in_array($brand->id,$selected)) checked @endif type="checkbox" id="brand_{{$brand->id}}" name="brand[]" value="{{$brand->id}}">
                    <label for="brand_{{$brand->id}}">
                        {{ $translate->name }}
                    </label>
                </div>
            @endforeach
        </div>
@endif

