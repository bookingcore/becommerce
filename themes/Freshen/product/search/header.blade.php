<?php
    $listing_list_style = request()->query('list_style');
;?>
@includeIf('product.sidebar-filter')
<div class="row">
    <div class="listing_filter_row dif db-767">
        <div class="col-md-4">
            <div class="left_area tac-sm mb30-767">
                <p class="heading-color fz14">{{$rows->total()}}</strong> {{__('Products found')}}</p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="listing_list_style tac-767">
                <ul class="mb0">
                    <li class="list-inline-item">
                        <a id="open2" class="filter_open_btn style2 @if(empty($show_filter))dn db-lg @endif" href="#"><span class="flaticon-setting-lines mr10"></span> {{__("Filters")}}</a>
                    </li>
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
                    <li class="list-inline-item gird {{$listing_list_style!='list'?'active':''}}"><a href="{{request()->fullUrlWithQuery(['list_style'=>''])}}"><span class="fa fa-th-large"></span></a></li>
                    <li class="list-inline-item list {{$listing_list_style=='list'?'active':''}}"><a href="{{request()->fullUrlWithQuery(['list_style'=>'list'])}}"><span class="fa fa-th-list"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

