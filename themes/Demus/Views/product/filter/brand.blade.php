@if(!empty($brands))
    @php
        $selected = (array) Request::query('brand');
    @endphp
        <h3 class="widget_title">{{__("By Brands")}}</h3>
        <div class="demus-checkbox-brands">
            @foreach($brands as $item=>$brand)
                @php $translate = $brand->translate(app()->getLocale()) @endphp
                <div class="demus-checkbox">
                    <input @if(in_array($brand->id,$selected)) checked @endif type="checkbox" id="brand_{{$brand->id}}" name="brand[]" value="{{$brand->id}}">
                    <label for="brand_{{$brand->id}}">
                        {{ $translate->name }}
                    </label>
                </div>
            @endforeach
        </div>
@endif

