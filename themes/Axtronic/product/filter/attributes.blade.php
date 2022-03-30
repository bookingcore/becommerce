@php
    $selected = (array) Request::query('terms');
@endphp
@foreach ($attributes as $item)
    @php
        $translate = $item->translate(app()->getLocale());
    @endphp
    @if($translate->name === 'Color')
        <div class="widget-attribute widget-attribute-color">
            <h4 class="widget_title">{{__('FILTER BY ')}} {{$translate->name}}</h4>
            @foreach($item->terms as $key => $term)
                @php $translate = $term->translate(app()->getLocale()); @endphp
                <div class="axtronic-checkbox">
                    <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                    <label for="term-{{$term->id}}" style="background-color: {{$translate->name}}">{!! clean($translate->name) !!}</label>
                </div>
            @endforeach
        </div>
    @else
        <div class="widget-attribute">
            <h4 class="widget_title">{{__('FILTER BY ')}} {{$translate->name}}</h4>
            @foreach($item->terms as $key => $term)
                @php $translate = $term->translate(app()->getLocale()); @endphp
                <div class="axtronic-checkbox">
                    <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                    <label for="term-{{$term->id}}">{!! clean($translate->name) !!}</label>
                </div>
            @endforeach
        </div>
    @endif


@endforeach
