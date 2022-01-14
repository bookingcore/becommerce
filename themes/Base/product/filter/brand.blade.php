@if(!empty($brands))
    @php
        $selected = (array) Request::query('brand');
    @endphp
    <div class="mb-3 border-bottom pb-3">
        <h4 class="widget-title fs-22 mb-2">{{__("By Brands")}}</h4>
        <div>
            @foreach($brands as $item=>$brand)
                @php $translate = $brand->translate(app()->getLocale()) @endphp
                <div class="mb-1">
                    <input @if(in_array($brand->id,$selected)) checked @endif type="checkbox" id="brand_{{$brand->id}}" name="brand[]" value="{{$brand->id}}">
                    <label for="brand_{{$brand->id}}">
                        {{ $translate->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endif
