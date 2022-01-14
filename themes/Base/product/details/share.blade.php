<div class="bc-product_sharing">
    <a target="_blank" class="facebook" href="http://www.facebook.com/sharer.php?u={{$row->getDetailUrl()}}" title="{{$translation->title}}">
        <i class="fa fa-facebook"></i>
    </a>
    <a target="_blank" class="twitter" href="http://twitter.com/share?text={{$translation->title}}&amp;url={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="fa fa-twitter"></i>
    </a>
    <a target="_blank" class="google" href="https://plus.google.com/share?{{$translation->title}}&amp;text={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="fa fa-google-plus"></i>
    </a>
    <a target="_blank" class="linkedin" href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}" >
        <i class="fa fa-linkedin"></i>
    </a>
</div>
