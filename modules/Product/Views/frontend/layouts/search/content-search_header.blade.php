@if(empty($_GET['s']))
    <header class="woocommerce-products-header">
        <h2 class="mf-catalog-title">{{__(setting_item_with_lang("product_page_search_title"))}}</h2>
        <div class="mf-catalog-banners">
            <ul id="mf-catalog-banners">
                @if($list = setting_item('list_sliders'))
                    @foreach(json_decode($list) as $item)
                        <li><a href="#"><img src="{{get_file_url($item->image_id,'full')}}" alt="{{$item->title}}"></a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </header>
@endif
