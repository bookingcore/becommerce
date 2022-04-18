@php
    $product_image = setting_item('product_image');

@endphp
@if($product_image)
@php
    $file = (new \Modules\Media\Models\MediaFile())->findById($product_image);
@endphp
<div class="mb-4">
    <img src="{{asset('uploads/'.$file['file_path'])}}" alt="">
</div>
@endif
<div class="axtronic-shopping__header d-flex justify-content-between align-items-center">
    <h2> {{ setting_item('product_page_search_title') }}</h2>
    <p>{{ __("Showing :from - :to of :total",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]), "results"}}  </p>
</div>
<div class="axtronic-shopping__actions">
    <div class="axtronic-ordering">
        <label for="soft"> {{ __('Soft By') }} </label>
        <select name="sort" data-placeholder="{{ __("Sort Items") }}">
            <option value="">{{ __("Sort by latest") }}</option>
            <option @if(request('sort') == 'rate') selected @endif value="rate">{{ __("Sort by average rating") }}</option>
            <option @if(request('sort') == 'price_asc') selected @endif value="price_asc">{{ __("Sort by price: low to high") }}</option>
            <option @if(request('sort') == 'price_desc') selected @endif value="price_desc">{{ __("Sort by price: high to low") }}</option>
        </select>
    </div>

    <div class="gridlist-toggle desktop-hide-down">
        <a href="?layout=grid" class="grid  active" title="{{__('Grid View')}}"><i class="axtronic-icon-grid"></i></a>
        <a href="?layout=list" class="list  " title="{{__('List View')}}"><i class="axtronic-icon-list"></i></a>
    </div>

</div>
