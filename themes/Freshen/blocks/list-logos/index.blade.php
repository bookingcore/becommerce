@if(!empty($list_items))
    <!-- Our Partners -->
    <section id="our-partners" class="our-partners bt1 pt60 pb60">
        <div class="container">
            <div class="row">
                @foreach($list_items as $key => $item)
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="partner_item mb30-sm">
                            <img src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ __("Partner") }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

