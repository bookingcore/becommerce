<div class="SearchTrending">
    <div class="container">
        <div class="mf-category-tabs">
            <div class="tabs-title">
                <h2>{{ $title ?? '' }}</h2>
                <span>{{ $update_at ?? '' }}</span>
            </div>
            @if(!empty($tab_trending))
            <div class="martfury-tabs">
                <div class="tabs-header">
                    <ul class="tabs-nav">
                        @php $stt = 1; @endphp
                        @foreach($tab_trending as $item)
                            <li @if($stt == 1) class="active" @endif data-tab="tab-content-{{$stt}}">
                                <a href="#" tabindex="0" @if($stt == 1) class="active" @endif>
                                    <span class="mf-icon"><i class="{{$item['icon']}}"></i></span>
                                    <h2>{{$item['title']}}</h2>
                                </a>
                            </li>
                            @php $stt++; @endphp
                        @endforeach
                    </ul>
                </div>
                <div class="tabs-content">
                    @php $stt_content = 1; @endphp
                    @foreach($tab_trending as $content)
                        @php
                            $model_product = \Modules\Product\Models\Product::select("*");
                            $categories = [];
                            if(empty($content['order'])) $content['order'] = "id";
                            if(empty($content['order_by'])) $content['order_by'] = "desc";
                            if(empty($content['number'])) $content['number'] = 10;
                            if (isset($content['category_id']) && $category_ids = $content['category_id']) {
                                $model_product->join('product_category_relations', function ($join) use ($category_ids) {
                                    $join->on('products.id', '=', 'product_category_relations.target_id')
                                        ->whereIn('product_category_relations.cat_id', $category_ids);
                                });
                                $categories = \Modules\Product\Models\ProductCategory::select('name','id','slug')->whereIn('id', $category_ids)->get();
                            }
                            $model_product->orderBy("products.".$content['order'], $content['order_by']);
                            $model_product->where("products.status", "publish");
                            $model_product->groupBy("products.id");
                            $list = $model_product->limit($content['number'])->get();
                        @endphp

                        <div class="tabs-panel {{ $stt_content == 1 ? 'active' : '' }}" id="tab-content-{{$stt_content}}">
                            <ul>
                                @foreach($list as $item)
                                    <li>
                                        <a href="{{route('product.detail',['slug'=>$item->slug])}}">
                                            <span class="t-imgage">{!! get_image_tag($item->image_id,'thumb') !!}</span>
                                            <h2 class="text-left">{{ $item->title }}</h2>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @php $stt_content++; @endphp
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
