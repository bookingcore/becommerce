<div class="social-links">
    <a class="share-facebook martfury-facebook" title="{{$translation->title}}" href="http://www.facebook.com/sharer.php?u={{$row->getDetailUrl()}}" target="_blank">
        <i class="fa fa-facebook"></i>
    </a>
    <a class="share-twitter martfury-twitter" href="http://twitter.com/share?text={{$translation->title}}&amp;url={{$row->getDetailUrl()}}" title="{{$translation->title}}" target="_blank">
        <i class="fa fa-twitter"></i>
    </a>
    <a class="share-google-plus martfury-google-plus" href="https://plus.google.com/share?{{$translation->title}}&amp;text={{$row->getDetailUrl()}}" title="{{$translation->title}}" target="_blank">
        <i class="fa fa-google-plus"></i>
    </a>
    <a class="share-linkedin martfury-linkedin" href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}" target="_blank">
        <i class="fa fa-linkedin"></i>
    </a>
    <a class="share-vkontakte martfury-vkontakte" href="http://vk.com/share.php?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}" target="_blank">
        <i class="fa fa-vk"></i>
    </a>
    <a class="share-pinterest martfury-pinterest" href="http://pinterest.com/pin/create/button?url={{$row->getDetailUrl()}}&amp;description={{$translation->title}}" title="{{$translation->title}}" target="_blank">
        <i class="fa fa-pinterest"></i>
    </a>
</div>
