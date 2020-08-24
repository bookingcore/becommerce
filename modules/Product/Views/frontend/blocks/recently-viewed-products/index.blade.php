@if(!empty($rows))
    <div class="bravo-recently-viewed-products mf-recently-products">
        <div class="container">
            <div class="recently-header">
                <h2 class="title">{{ $title }}</h2>
                <a href="{{ route('product.recent.viewed') }}" class="link">{{ __('View All') }}</a>
            </div>

            <ul class="product-list">
                @foreach($rows as $row)
                    <li>
                        <a href="{{ route('product.detail',['slug'=>$row->slug]) }}">
                            {!! get_image_tag($row->image_id) !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
