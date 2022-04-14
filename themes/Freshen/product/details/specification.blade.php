<ul class="sspd_sku mb30">
    @if($row->sku and $row->product_type != "variable")
        <li><a href="#">{{__("SKU: ")}}</a> <span>{{$row->sku}}</span></li>
    @endif
        @if($row->quantity and $row->remain_stock and in_array($row->product_type,["simple","variable"]) and $row->check_manage_stock())
            <li><a href="#">{{__("Quantity: ")}}</a> {{$row->remain_stock}} {{__("in stock")}}</li>
        @endif
    @if(!empty($row->categories))
        <li><a href="#">{{ __("Categories:") }}</a>
            @foreach($row->categories as $k=>$category)
                @if($k) ,
                @endif
                <a class="c-main" href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
            @endforeach
        </li>
    @endif
    @if(!empty($row->tags))
        <li>
            <a href="#">{{ __("Tags:") }}</a>
            @foreach($row->tags as $k=>$category)
                @if($k) , @endif
                <a class="initial" href="{{ route('product.index')."?tag=$category->slug" }}">{{$category->name}}</a>
            @endforeach
        </li>
    @endif
    <li class="df">
        <a href="#">{{ __("Share:") }}</a>
        <span class="social_icons">
              <ul class="mb0">
                    <li class="list-inline-item">
                        <a href="http://www.facebook.com/sharer.php?u={{$row->getDetailUrl()}}" title="{{$translation->title}}"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="http://twitter.com/share?text={{$translation->title}}&amp;url={{$row->getDetailUrl()}}" title="{{$translation->title}}"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://plus.google.com/share?{{$translation->title}}&amp;text={{$row->getDetailUrl()}}" title="{{$translation->title}}"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="http://www.linkedin.com/shareArticle?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" title="{{$translation->title}}"><i class="fa fa-linkedin"></i></a>
                    </li>
              </ul>
        </span>
    </li>
</ul>
