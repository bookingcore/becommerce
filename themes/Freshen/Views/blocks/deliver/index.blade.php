@if(!empty($title))
    <section class="deliver-divider pt0 pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="online_delivery text-center">
                        <div class="delivery_bike">
                            @if(!empty($image_url))
                                <img src="{{ $image_url }}" alt="{{ $title }}">
                            @endif
                        </div>
                        <h3 class="title text-thm2">
                            <span class="flaticon-whatsapp text-thm vam mr15"></span>
                            {{ $title }}
                            <span class="text-thm">{{ $phone }}</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

