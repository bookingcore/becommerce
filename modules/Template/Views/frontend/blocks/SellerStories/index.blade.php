<div class="bravo_SellerStories">
    <div class="container">
        <h4 class="bravo-header-title mf-semi-bold">{!! $title !!}</h4>
        <h2 class="bravo-sub-title mf-regular">{!! $sub_title !!}</h2>

        <div class="martfury-testimonial-slides">
            <div class="testimonial-list">
                @if(!empty($sliders))
                    @foreach($sliders as $item)
                        <div class="testimonial-info">
                                <i class="fa fa-quote-right fa-2x" aria-hidden="true"></i>
                                <div class="testi-thumb">
                                    <img src="{{get_file_url($item['avatar'], 'full')}}" alt="{{$item['name']}}">
                                </div>
                                <div class="testi-header">
                                    <span class="name">{{$item['name']}} /</span><span class="job">{{$item['job']}}</span>
                                </div>
                                <div class="desc">
                                    {{$item['content']}}
                                </div>
                                <a href="{{$item['link']}}" target=" _blank">{{$item['link_title']}}<i class="icon-play-circle"></i></a>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
