<div class="ps-section--gray">
    <div class="container">
        <div class="ps-block--products-of-category">
            <div class="ps-block__categories">
                <h3>{{ $title }}</h3>
                @if(!empty($custom_link))
                    <ul>
                        @foreach($custom_link as $item)
                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <a class="ps-block__more-link" href="{{ !empty($link_all) ? $link_all : route("product.index") }}">
                    {{ __("View All") }}
                </a>
            </div>
            <div class="ps-block__slider">
                <div class="ps-carousel--product-box owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="500" data-owl-mousedrag="off">
                    @if(!empty($sliders))
                        @foreach($sliders as $item)
                            <a href="{{ $item['link'] }}">
                                {!! get_image_tag($item['image'],'full',['lazy'=>false,'alt'=>$item['title']]) !!}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="ps-block__product-box">
                @if(!empty($rows))
                    @foreach($rows as $row)
                        @include('product.search.loop-item',['class'=>'ps-product--simple'])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>