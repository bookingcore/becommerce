@if(!empty($categories))
    <div class="terms_condition_widget filter_sidebar pt0">
        <h4 class="title">{{__('PRODUCT CATEGORIES')}}</h4>
        <div class="widget_list">
            <ul class="list_details">
                @foreach($categories as $category)
                    @php($translate = $category->translate(app()->getLocale()))
                    <li><a href="{{$category->getDetailUrl()}}">{{$translate->name}} <span class="float-end">{{$category->product_count}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <hr>
    </div>
@endif
