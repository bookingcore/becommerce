@php
    $selected = (array) Request::query('terms');
@endphp
@foreach ($attributes as $item)
    @php
        $translate = $item->translate(app()->getLocale());
    @endphp
    @if($translate->origin_id == $widget['attr'])
        @if($translate->name == 'Color')
            <div class="widget widget-attribute widget-attribute-color">
                <h6 class="widget_title"> {{$translate->name}}</h6>
                @foreach($item->terms as $key => $term)
                    @php $translate = $term->translate(app()->getLocale()); @endphp
                    <div class="bc-checkbox @if(in_array($term->id,$selected)) item-active @endif">
                        <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                        <label for="term-{{$term->id}}" style="background-color: {{$translate->name}}">{!! clean($translate->name) !!}</label>
                    </div>
                @endforeach
            </div>
        @else
            <div class="widget widget-attribute">
                <h6 class="widget_title">{{$translate->name}}</h6>
                @foreach($item->terms as $key => $term)
                    @php $translate = $term->translate(app()->getLocale()); @endphp
                    <div class="bc-checkbox @if(in_array($term->id,$selected)) item-active @endif">
                        <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                        <label for="term-{{$term->id}}">{!! clean($translate->name) !!}</label>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endforeach
