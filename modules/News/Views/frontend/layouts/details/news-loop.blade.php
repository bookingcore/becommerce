@foreach($rows as $row)
    @php
        $translation = $row->translateOrOrigin(app()->getLocale()); @endphp

    <article class="col-md-6 col-sm-6 col-xs-6 blog-wapper">
        @if($image_tag = get_image_tag($row->image_id,'full'))
                <header class="entry-header">
                    <div class="entry-format format-audio">
                        <a class="entry-image" href="{{$row->getDetailUrl()}}">
                            {!! $image_tag !!}
                        </a>
                    </div>
                </header>
        @endif
        <!-- .entry-header -->
        <div class="entry-content">
            <div class="entry-content-top">
                <div class="categories-links">
                    @php $category = $row->getCategory; @endphp
                    <a href="{{$category->getDetailUrl(app()->getLocale())}}">{{$category->name}}</a>
                </div>
                <h2 class="entry-title">
                    <a href="{{$row->getDetailUrl()}}" rel="bookmark">{{$translation->title}}</a>
                </h2>
            </div>
            <div class="entry-content-bottom">
                <a class="entry-meta" rel="bookmark">{{__('DATE ')}}  {{ display_date($row->updated_at)}}</a>
                <span class="entry-author entry-meta"> {{ __('by ')}}
                    <a class="url fn n">{{$row->getAuthor->getDisplayName() ?? ''}}</a>
                </span>
            </div>
        </div>
        <!-- .entry-content -->

    </article>
@endforeach
