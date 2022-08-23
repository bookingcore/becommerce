<?php
$listing_list_style = request()->query('list_style');
;?>
<div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3">
    <div class="left_area ">
        <p class="heading-color mb-0">{{$rows->total()}}</strong> {{__('Products found')}}</p>
    </div>

    <div class="listing_list_style ">
        <ul class="mb-0">
            <li class="list-inline-item gird {{$listing_list_style!='list'?'active':''}}"><a href="{{request()->fullUrlWithQuery(['list_style'=>''])}}"><span class="fa fa-th-large"></span></a></li>
            <li class="list-inline-item list {{$listing_list_style=='list'?'active':''}}"><a href="{{request()->fullUrlWithQuery(['list_style'=>'list'])}}"><span class="fa fa-th-list"></span></a></li>
            <li class="list-inline-item">
                <div class="shop_default_listing htlw_form_select bc-shopping__actions">
                    <select name="sort" class="custom_select_dd" id="selectbox_default_list">
                        <option value="">{{ __("Default sorting") }}</option>
                        <option @if(request('sort') == 'rate') selected @endif value="rate">{{ __("Average rating") }}</option>
                        <option @if(request('sort') == 'price_asc') selected @endif value="price_asc">{{ __("Price: low to high") }}</option>
                        <option @if(request('sort') == 'price_desc') selected @endif value="price_desc">{{ __("Price: high to low") }}</option>
                    </select>
                </div>
            </li>
        </ul>
    </div>
</div>


