<div class="BestSellerBrands">
    <div class="container">
        <div class="best_seller__header">
            <h3>{{$title ?? ''}}</h3>
        </div>
        <div class="best_seller__content">
            @if(!empty($item))
                @foreach($item as $row)
                    <div class="image-item">
                        <div class="image-item__wrapper">
                            <a href="{{$row['link']}}" target="_blank" rel="nofollow" class="img-link">
                                {!! get_image_tag($row['image'],'thumb',['alt'=>$row['title']]) !!}
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
