@php
    $selected = (array) Request::query('terms');
@endphp
@foreach ($attributes as $item)
    @php
        $translate = $item->translate(app()->getLocale());
    @endphp
    <div class="mb-3 border-bottom pb-3 border-t divide-gray-200 pt-2">
        <h4 class="widget-title fs-22 mb-2 text-base font-[500]">{{$translate->name}}</h4>
        @foreach($item->terms as $key => $term)
            @php $translate = $term->translate(app()->getLocale()); @endphp
            <div class="bc-checkbox">
                <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                <label for="term-{{$term->id}}">{!! clean($translate->name) !!}</label>
            </div>
        @endforeach
    </div>
@endforeach
