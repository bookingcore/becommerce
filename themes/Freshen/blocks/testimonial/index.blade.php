@if(!empty($list_items))
    <section class="our-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="testimonialsec">
                        <ul class="tes-for">
                            @foreach($list_items as $item)
                                <li>
                                    <div class="testimonial_item">
                                        <div class="details">
                                            <span class="icon">“</span>
                                            <p>{{ $item['desc'] }}</p>
                                            <h5>{{ $item['name'] }}</h5>
                                            <span class="small">{{ $item['position'] }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
