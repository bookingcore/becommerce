<div class="axtronic-product_sharing pt-3">
    <a target="_blank" class="facebook" href="http://www.facebook.com/sharer.php?u={{$row->getDetailUrl()}}" title="{{$translation->title}}">
        <i class="axtronic-icon-facebook"></i>
    </a>
    <a target="_blank" class="twitter" href="http://twitter.com/share?text={{$translation->title}}&amp;url={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="axtronic-icon-twitter"></i>
    </a>
    <a target="_blank" class="social-envelope" href="https://plus.google.com/share?{{$translation->title}}&amp;text={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="axtronic-icon-envelope"></i>
    </a>
    <a target="_blank" class="pinterest" href="https://www.pinterest.com/pin/create/button/?url={{$row->getDetailUrl()}}&amp;description={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="axtronic-icon-pinterest-p"></i>
    </a>
    <a target="_blank" class="linkedin" href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}" >
        <i class="axtronic-icon-linkedin"></i>
    </a>
</div>
