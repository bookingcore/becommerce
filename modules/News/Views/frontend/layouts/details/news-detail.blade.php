<div class="article single-post">
    <header class="header entry-header">
        @if($image_url = get_file_url($row->image_id, 'full'))
            <div class="entry-images">
                <img src="{{ $image_url  }}" alt="{{$translation->title}}">
            </div>
        @endif
        <div class="cate">
            @php $category = $row->getCategory; @endphp
            @if(!empty($category))
                @php $t = $category->translateOrOrigin(app()->getLocale()); @endphp
                <ul>
                    <li>
                        <a href="{{$category->getDetailUrl(app()->getLocale())}}">
                            {{$t->name ?? ''}}
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </header>
    <h2 class="title">{{$translation->title}}</h2>
    <div class="post-info">
        <ul>
            @if(!empty($row->getAuthor))
                <li>
                    <span> {{ __('BY ')}} </span>
                    {{$row->getAuthor->getDisplayName() ?? ''}}
                </li>
            @endif
            <li> {{__('DATE ')}}  {{ display_date($row->updated_at)}}  </li>
        </ul>
    </div>
    <div class="post-content"> {!! clean($translation->content) !!}</div>
    <div class="entry-footer">
        @if (!empty($tags = $row->getTags()) and count($tags) > 0)
            <span class="tags-links"><strong>{{__("Tags:")}} </strong>
                @foreach($tags as $tag)
                    @php $t = $tag->translateOrOrigin(app()->getLocale()); @endphp
                    <a href="{{ $tag->getDetailUrl(app()->getLocale()) }}" rel="tag">{{$t->name ?? ''}}</a>,
                @endforeach
            </span>
        @endif
        <div class="footer-socials">
            <div class="social-links">
                <a class="share-facebook martfury-facebook"
                   title="{{__("Facebook")}}"
                   href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"
                   target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
                <a class="share-twitter martfury-twitter"
                   href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"
                   title="{{__("Twitter")}}"
                   target="_blank">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a class="share-google-plus martfury-google-plus"
                   title="{{__("Google Plus")}}"
                   href="https://plus.google.com/share?url={{$row->getDetailUrl()}}&amp;text={{$translation->title}}"
                   target="_blank">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a class="share-linkedin martfury-linkedin"
                   href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"
                   title="{{__("Linkedin")}}"
                   target="_blank">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </a>
                <a class="share-vkontakte martfury-vkontakte"
                   href="http://vk.com/share.php?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"
                   title="{{__('Vkontakte')}}"
                   target="_blank">
                    <i class="fa fa-vk"></i>
                </a>
                <a class="share-pinterest martfury-pinterest"
                   href="http://pinterest.com/pin/create/button?url={{$row->getDetailUrl()}}&amp;description={{$translation->title}}"
                   title="{{__('Pinterest')}}"
                   target="_blank">
                    <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @include('News::frontend.layouts.details.related-news')
    </div>
</div>

