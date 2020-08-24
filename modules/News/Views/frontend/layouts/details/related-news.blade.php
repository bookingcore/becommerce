<div class="mf-related-posts" id="mf-related-posts"><h2 class="related-title">{{ __('Related Posts') }}</h2>
    <div class="row">
        @if(!empty($related))
            @foreach($related as $item)
                <div class="blog-wapper col-md-4 col-sm-6 col-xs-6">
                    <div class="entry-header">
                        <a class="entry-image" href="{{$item->getDetailUrl()}}" tabindex="0">
                            {!! get_image_tag($item->image_id,'full') !!}
                        </a>
                    </div>
                    <div class="entry-content">
                        <div class="entry-content-top">
                            <div class="categories-links">
                                <a rel="category tag" tabindex="0">{{$item->getCategory->name}}</a>
                            </div>
                            <h2 class="entry-title">
                                <a href="{{$item->getDetailUrl()}}" rel="bookmark" tabindex="0">{{$item->title}}</a>
                            </h2>
                        </div>
                        <div class="entry-content-bottom">
                            <a class="entry-meta" rel="bookmark">{{__('DATE ')}}  {{ display_date($item->updated_at)}}</a>
                            <span class="entry-author entry-meta"> {{ __('by ')}}
                                <a class="url fn n">{{$item->getAuthor->getDisplayName() ?? ''}}</a>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
