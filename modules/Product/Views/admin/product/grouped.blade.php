<div class="form-group mb-3" data-condition="product_type:is(grouped)">
    <label class="control-label">{{__("Grouped Products")}}</label>
    <div class="controls">
        <div class="form-group-item">
            <div class="bc-grouped-product bc-search-box dropdown be-dropdown  mb-3" data-url="{{route('product.admin.getForSelect2',['need'=>['price'],'not_in_ids'=>[$row->id]])}}" data-template="product-item-template">
                <input type="text" class="form-control search-input be-dropdown-toggle" data-display="static" data-{{isset($bs5) ? 'bs-' : ''}}toggle="dropdown" placeholder="{{__("Search product name...")}}">
                <div class="dropdown-menu be-dropdown-menu w-full w-100 hidden origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="right:0px" aria-labelledby="dropdownMenuLink">
                </div>
                <div class="d-none template hidden">
                    <div class="no-data"><div class="alert alert-warning m-2">{{__("No result found")}}</div></div>
                </div>
            </div>

            <div class="g-items-header">
                <div class="row grid  grid-cols-12 gap-4 ">
                    <div class="col-md-1 w-1/6">{{__("ID")}}</div>
                    <div class="col-md-10 text-left col-span-10">{{__("Product")}}</div>
                    <div class="col-md-1 w-1/6"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->children))
                    @php $stt = 0; @endphp
                    @foreach($row->children as $stt=>$product)
                        <div class="item" data-number="{{$stt}}">
                            <input type="hidden" name="children[{{$stt}}]" value="{{$product->id}}">
                            <div class="row grid grid-cols-12 gap-4">
                                <div class="col-md-1 col-span-1">#{{$product->id}}</div>
                                <div class="col-md-1 col-span-1">
                                    @if($product->image_id)
                                        <img src="{{get_file_url($product->image_id)}}" width="30" alt="">
                                    @endif
                                </div>
                                <div class="col-md-5 col-span-5">{{$product->title}}</div>
                                <div class="col-md-2 col-span-2">{{$product->type_name}}</div>
                                <div class="col-md-2 col-span-2">{{format_money($product->sale_price)}}</div>
                                <div class="col-md-1 col-span-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        @php $stt++; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group mb-3" >
    <label class="control-label">{{__("Up-sell Products")}}</label>
    <div class="controls">
        <div class="form-group-item">
            <div class="bc-up-sell-product bc-search-box dropdown mb-3 be-dropdown" data-url="{{route('product.admin.getForSelect2',['need'=>['price'],'not_in_ids'=>[$row->id]])}}" data-template="product-item-template">
                <input type="text" class="form-control search-input be-dropdown-toggle" data-display="static" data-{{isset($bs5) ? 'bs-' : ''}}toggle="dropdown" placeholder="{{__("Search product name...")}}">
                <div class="dropdown-menu be-dropdown-menu w-full w-100 hidden origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="right:0px" aria-labelledby="dropdownMenuLink">
                </div>
                <div class="d-none hidden template">
                    <div class="no-data"><div class="alert alert-warning m-2">{{__("No result found")}}</div></div>
                </div>
            </div>

            <div class="g-items-header">
                <div class="row grid  grid-cols-12 gap-4 ">
                    <div class="col-md-1 col-span-1">{{__("ID")}}</div>
                    <div class="col-md-10 text-left col-span-10">{{__("Product")}}</div>
                    <div class="col-md-1 col-span-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->up_sell))
                    @php $stt = 0; @endphp
                    @foreach($row->up_sell as $stt=>$product)
                        <div class="item" data-number="{{$stt}}">
                            <input type="hidden" name="up_sell[{{$stt}}]" value="{{$product->id}}">
                            <div class="row grid  grid-cols-12 gap-4">
                                <div class="col-md-1 col-span-1">#{{$product->id}}</div>
                                <div class="col-md-1 col-span-1">
                                    @if($product->image_id)
                                        <img src="{{get_file_url($product->image_id)}}" width="30" alt="">
                                    @endif
                                </div>
                                <div class="col-md-5 col-span-5">{{$product->title}}</div>
                                <div class="col-md-2 col-span-2">{{$product->type_name}}</div>
                                <div class="col-md-2 col-span-2">{{format_money($product->sale_price)}}</div>
                                <div class="col-md-1 col-span-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        @php $stt++; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group mb-3" >
    <label class="control-label">{{__("Cross-sell Products")}}</label>
    <div class="controls">
        <div class="form-group-item">
            <div class="bc-cross-sell-product bc-search-box dropdown be-dropdown mb-3" data-url="{{route('product.admin.getForSelect2',['need'=>['price'],'not_in_ids'=>[$row->id]])}}" data-template="product-item-template">
                <input type="text" class="form-control search-input be-dropdown-toggle" data-display="static" data-{{isset($bs5) ? 'bs-' : ''}}toggle="dropdown" placeholder="{{__("Search product name...")}}">
                <div class="py-1 dropdown-menu be-dropdown-menu w-full w-100 hidden origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="right:0px" aria-labelledby="dropdownMenuLink">
                </div>
                <div class="d-none template hidden">
                    <div class="no-data"><div class="alert alert-warning m-2">{{__("No result found")}}</div></div>
                </div>
            </div>

            <div class="g-items-header">
                <div class="row grid  grid-cols-12 gap-4">
                    <div class="col-md-1 col-span-1">{{__("ID")}}</div>
                    <div class="col-md-10 col-span-10 text-left">{{__("Product")}}</div>
                    <div class="col-md-1 col-span-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->cross_sell))
                    @php $stt = 0; @endphp
                    @foreach($row->cross_sell as $stt=>$product)
                        <div class="item" data-number="{{$stt}}">
                            <input type="hidden" name="cross_sell[{{$stt}}]" value="{{$product->id}}">
                            <div class="row grid  grid-cols-12 gap-4">
                                <div class="col-md-1 col-span-1">#{{$product->id}}</div>
                                <div class="col-md-1 col-span-1">
                                    @if($product->image_id)
                                        <img src="{{get_file_url($product->image_id)}}" width="30" alt="">
                                    @endif
                                </div>
                                <div class="col-md-5 col-span-5">{{$product->title}}</div>
                                <div class="col-md-2 col-span-2">{{$product->type_name}}</div>
                                <div class="col-md-2 col-span-2">{{format_money($product->sale_price)}}</div>
                                <div class="col-md-1 col-span-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        @php $stt++; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<script id="product-item-template" type="text/x-handlebars-template">
    <div class="dropdown-item grouped-product-item gap-4 px-3 py-2 hover:bg-gray-100 " style="cursor: pointer" role="button">
        <div class="row grid  grid-cols-12 flex items-center">
            <div class="col-md-1 col-span-1">
                @{{#if image_url}}
                    <img width="30px" src="@{{ image_url }}">
                @{{/if}}
            </div>
            <div class="col-md-6 col-span-6">@{{ title }}</div>
            <div class="col-md-2 col-span-2">@{{ product_type }}</div>
            <div class="col-md-3 text-right text-end col-span-3">@{{ price_html }}</div>
        </div>
    </div>
</script>

<script id="grouped-item-template" type="text/x-handlebars-template">
    <div class="item" data-number="__number__" >
        <input type="hidden" name="children[]" value="@{{id}}" >
        <div class="row grid  grid-cols-12 gap-4  flex items-center">
            <div class="col-md-1 col-span-1">
                #@{{id}}
            </div>
            <div class="col-md-1 col-span-1">
                @{{#if image_url}}
                <img width="30px" src="@{{ image_url }}">
                @{{/if}}
            </div>
            <div class="col-md-5 col-span-5">
                @{{ title }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ product_type }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ price_html }}
            </div>
            <div class="col-md-1 col-span-1">
                <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</script>

<script id="up-sell-item-template" type="text/x-handlebars-template">
    <div class="item" data-number="__number__" >
        <input type="hidden" name="up_sell[]" value="@{{id}}" >
        <div class="row grid  grid-cols-12 gap-4  flex items-center">
            <div class="col-md-1 col-span-1">
                #@{{id}}
            </div>
            <div class="col-md-1 col-span-1">
                @{{#if image_url}}
                <img width="30px" src="@{{ image_url }}">
                @{{/if}}
            </div>
            <div class="col-md-5 col-span-5">
                @{{ title }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ product_type }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ price_html }}
            </div>
            <div class="col-md-1 col-span-1">
                <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</script>
<script id="cross-sell-item-template" type="text/x-handlebars-template">
    <div class="item" data-number="__number__" >
        <input type="hidden" name="cross_sell[]" value="@{{id}}" >
        <div class="row grid  grid-cols-12 gap-4  flex items-center">
            <div class="col-md-1 col-span-1">
                #@{{id}}
            </div>
            <div class="col-md-1 col-span-1">
                @{{#if image_url}}
                <img width="30px" src="@{{ image_url }}">
                @{{/if}}
            </div>
            <div class="col-md-5 col-span-5">
                @{{ title }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ product_type }}
            </div>
            <div class="col-md-2 col-span-2">
                @{{ price_html }}
            </div>
            <div class="col-md-1 col-span-1">
                <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</script>
