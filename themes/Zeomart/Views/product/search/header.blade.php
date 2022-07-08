<div class="flex align-center">
    <div><strong> {{$rows->total()}}</strong> {{__('Products found')}}</div>
    <div class="bc-shopping__actions">
        <select class="form-select" name="sort" data-placeholder="{{ __("Sort Items") }}">
            <option value="">{{ __("Sort by latest") }}</option>
            <option @if(request('sort') == 'rate') selected @endif value="rate">{{ __("Sort by average rating") }}</option>
            <option @if(request('sort') == 'price_asc') selected @endif value="price_asc">{{ __("Sort by price: low to high") }}</option>
            <option @if(request('sort') == 'price_desc') selected @endif value="price_desc">{{ __("Sort by price: high to low") }}</option>
        </select>
    </div>
</div>
