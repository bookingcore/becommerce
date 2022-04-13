@if(!empty($list_items))
    <section class="instagram-posts pt0 pb80">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="main-title text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="instagram_slider">
                        @foreach($list_items as $key => $item)
                            <div class="item">
                                <div class="gallery_item">
                                    <img class="img-fluid img-circle-rounded w100" src="{{ get_file_url($item['image_id'] ?? '' , "full") }}" alt="Instagram">
                                    <div class="gallery_overlay">
                                        <a class="icon popup-img" href="{{ get_file_url($item['image_id'] ?? '' , "full") }}">
                                            <span class="fab fa-instagram"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
