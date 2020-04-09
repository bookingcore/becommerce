<div class="bravo_categories">
    <div class="martfury-container">
        <h3 class="categories-header semibold">{{__($title)}}</h3>
        <div class="list-item">
            @if(!empty($rows))
                @foreach($rows as $item)
                    <div class="item">
                        <div class="mf-image-box style-2 title-s1">
                            <a class="thumbnail" href="{{$item->getDetailUrl()}}">
                                {!! get_image_tag($item['image_id'], 'full') !!}
                            </a>
                            <div class="image-content">
                                <h2 class="box-title">
                                    <a href="{{$item->getDetailUrl()}}">{{$item['name']}}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
