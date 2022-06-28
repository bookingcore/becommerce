<?php

?>
<div class="form-group mb-3">
    <label>{{__("Grouped Products")}}</label>
    <div class="controls">
        <div class="form-group-item">
            <div class="bc-search-box dropdown mb-3" data-url="{{route('product.admin.getForSelect2')}}" data-template="product-item-template">
                <input type="text" class="form-control search-input" data-toggle="dropdown" placeholder="{{__("Search product name...")}}">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                </div>
                <div class="d-none template">
                    <div class="no-data"><div class="alert alert-warning">{{__("No result found")}}</div></div>
                </div>
            </div>

            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-1">{{__("ID")}}</div>
                    <div class="col-md-10 text-left">{{__("Product")}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->children))
                    @php $stt = 0; @endphp
                    @foreach($row->children as $stt=>$product)
                        <div class="item" data-number="{{$stt}}" style="padding: 0; border: none">
                            <input type="hidden" name="children[{{$stt}}]" value="{{$product->id}}">
                            <div class="row">
                                <div class="col-md-1">#{{$product->id}}</div>
                                <div class="col-md-2">
                                    {!! get_image_tag($product->image_id) !!}
                                </div>
                                <div class="col-md-8">{{$product->title}}</div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        @php $stt++; @endphp
                    @endforeach
                @endif
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__" style="padding: 0; border: none">
                    <input type="hidden" __name__="children[__number__]" >
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8"></div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="product-item-template" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-md-2">
            @{{#if image_url}}
                <img src="@{{ image_url }}">
            @{{/if}}
        </div>
        <div class="col-md-7">@{{ title }}</div>
        <div class="col-md-3">@{{ price_html }}</div>
    </div>
</script>
