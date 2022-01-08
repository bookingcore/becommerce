@if(!empty($list_items))
    <div class="ps-site-features pt-5 pb-5">
        <div class="container">
            <div class="ps-block--site-features ps-block--site-features-2">
                @foreach($list_items as $item)
                    <div class="ps-block__item">
                        <div class="ps-block__left">
                            <i class="{{$item['icon'] ?? 'icon-sync'}}"></i>
                        </div>
                        <div class="ps-block__right">
                            <h4>{{ $item['title'] ?? '' }}</h4>
                            <p>{{$item['sub_title'] ?? ''}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
