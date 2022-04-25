<!-- About Text Content -->
<section class="about-section bb1 pb130 mb70">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="about_thumb mb30-md">
                    @if(!empty($image_1))
                        <img class="thumb1" src="{{$image_1}}" alt="1.jpg">
                    @endif
                    @if(!empty($image_2))
                        <img class="img-fluid thumb2" src="{{$image_2}}" alt="2.jpg">
                    @endif
                    <a class="popup_video_btn popup-iframe popup-youtube" href="{{ $youtube }}">
                        <i class="flaticon-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="about_content">
                    <h2 class="title text-thm">
                        {{ $title }}
                    </h2>
                    @foreach($list_items as $key => $item)
                        <h4 class="subtitle">{{ $item['title'] }}</h4>
                        <p class="mb40">{{ $item['desc'] }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
