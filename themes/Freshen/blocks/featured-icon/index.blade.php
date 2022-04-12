@if(!empty($list_items))
    <section class="bc-site-features features bb1 pt30 pb20">
        <div class="container">
            <div class="row">
                @foreach($list_items as $item)
                    <div class="col-sm-6 col-xl-3">
                        <div class="icon_boxes home3_style">
                            <div class="icon">
                                <span class="{{$item['icon'] ?? 'fa fa-configs'}} text-thm3"></span>
                            </div>
                            <div class="details">
                                <h5 class="title">{{ $item['title'] ?? '' }}</h5>
                                <p class="para">{{$item['sub_title'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
