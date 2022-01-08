@php
    $selected = (array) Request::query('terms');
@endphp
@foreach ($attributes as $item)
    @php
        $translate = $item->translate(app()->getLocale());
    @endphp
    <figure>
        <h4 class="widget-title">{{$translate->name}}</h4>
        @foreach($item->terms as $key => $term)
            @php $translate = $term->translate(app()->getLocale()); @endphp
            <div class="bc-checkbox">
                <input class="form-control" @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                <label for="term-{{$term->id}}">{!! clean($translate->name) !!}</label>
            </div>
        @endforeach
    </figure>
@endforeach
