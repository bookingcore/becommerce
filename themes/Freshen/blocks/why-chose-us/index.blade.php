@if(!empty($list_items))
    <section class="whychose_us pt0 pb0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($list_items as $key => $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="why_chose_us home1_style">
                            <div class="icon">
                                <img src="{{ get_file_url($item['image_id'] ?? '' , "full") }}" alt="{{ $item['title'] }}">
                            </div>
                            <div class="details">
                                <h4 class="title">{{ $item['title'] }}</h4>
                                <p>{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
