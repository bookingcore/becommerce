<div class="container">
    <div class="mf-products-of-category">
        <div class="cats-info">
            <div class="cats-inner">
                <h2>
                    <a class="cat-title">{{ $title }}</a>
                </h2>
                <ul class="extra-links">
                    @if(count($custom_link))
                        @foreach($custom_link as $item)
                            <li>
                                <a class="extra-link" target="_blank" rel="nofollow" href="{{ $item['link'] }}">
                                    {{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="footer-link">
                <a class="link" href="{{ !empty($link_all) ? $link_all : route("product.index") }}">{{ __('View All') }}</a>
            </div>
        </div>
        <div class="images-slider">
            <div class="images-list">
                @if(!empty($sliders))
                    @foreach($sliders as $item)
                        <a class="image-item" href="{{ $item['link'] }}">
                            {!! get_image_tag($item['image'],'full',['lazy'=>false,'alt'=>$item['title']]) !!}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="products-box">
            <ul class="products list-unstyled">
                @if(!empty($rows))
                    @foreach($rows as $row)
                        @include('Product::frontend.layouts.product')
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
