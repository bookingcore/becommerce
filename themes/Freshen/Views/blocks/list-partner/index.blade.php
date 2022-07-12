@if(!empty($list_items))
    <div class="bc-list-partner">
        <section class="deliver-divider bg-img1" style="background-image: url({{ $bg_image_url }})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-6">
                        <div class="juice_divider_content">
                            <p class="sub_title">{!! $sub_title !!}</p>
                            <h2 class="title text-thm2">{!! $title !!}</h2>
                            <p class="para">{{ $desc }}</p>
                            <a href="{{ $link_shop }}" class="btn btn-thm dc_btn">
                                {{ __('GO SHOP') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-blog pt0 pb60">
            <div class="container">
                <div class="partner_divider">
                    <div class="row">
                        @foreach($list_items as $key => $item)
                            <div class="col">
                                <div class="partner_item">
                                    <img src="{{ get_file_url($item['image_id'] ?? '' , "full") }}" alt="{{ __('Logo Partner') }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endif

