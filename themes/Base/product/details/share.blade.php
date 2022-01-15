<div class="bc-product_sharing text-center w-40px h-40px d-inline-block pt-3">
    <a target="_blank" class="facebook bg-facebook c-white me-2" href="http://www.facebook.com/sharer.php?u={{$row->getDetailUrl()}}" title="{{$translation->title}}">
        <i class="fa fa-facebook fs-20"></i>
    </a>
    <a target="_blank" class="twitter bg-twitter c-white me-2" href="http://twitter.com/share?text={{$translation->title}}&amp;url={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="fa fa-twitter fs-20"></i>
    </a>
    <a target="_blank" class="google bg-google c-white me-2" href="https://plus.google.com/share?{{$translation->title}}&amp;text={{$row->getDetailUrl()}}" title="{{$translation->title}}" >
        <i class="fa fa-google-plus fs-20"></i>
    </a>
    <a target="_blank" class="linkedin bg-linkedin c-white me-2" href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}" >
        <i class="fa fa-linkedin fs-20"></i>
    </a>
</div>
