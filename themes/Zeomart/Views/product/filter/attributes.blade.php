@php
    $selected = (array) Request::query('terms');
@endphp
@foreach ($attributes as $item)
    @php
        $translate = $item->translate(app()->getLocale());
    @endphp
    <div class="g-filter-item mb-3 border-bottom pb-3 border-t divide-gray-200 pt-2">
        <div class="item-title relative">
            <h4 class="widget-title fs-22 mb-2 text-base font-[500]">{{$translate->name}}</h4>
            <svg class="cursor-pointer absolute h-6 w-6 right-0 top-1" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
            </svg>
        </div>
        <div class="item-content">
        @foreach($item->terms as $key => $term)
            @php $translate = $term->translate(app()->getLocale()); @endphp
            <div class="bc-checkbox">
                <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" id="term-{{$term->id}}" name="terms[]" value="{{$term->id}}">
                <label for="term-{{$term->id}}">{!! clean($translate->name) !!}</label>
            </div>
        @endforeach
        </div>
    </div>
@endforeach
