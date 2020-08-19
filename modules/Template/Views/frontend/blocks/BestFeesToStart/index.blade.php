<div class="bravo_BestFeesToStart">
    <div class="container">
        <h4 class="bravo-header-title mf-semi-bold">{!! clean($title) !!}</h4>
        <h2 class="bravo-sub-title mf-regular">{!! clean($sub_title) !!}</h2>
        <div class="text-center bravo-sub-content">{!! clean($sub_content) !!}</div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="bravo-item-list">
                    <div class="row">
                        @foreach($listPercent as $item)
                            <div class="col-md-6">
                                <div class="wpb_wrapper">
                                    <div class="martfury-bubbles">
                                        <div class="bubble">
                                            <div class="value">{!! clean($item['number']) !!}</div>
                                            <h5>{!! clean($item['title']) !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <h4 class="text-center mf-semi-bold title_list">{!! clean($title_list) !!}</h4>
                <div class="title-list-content">
                    {!! clean($title_list_content) !!}
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row payment-box">
                    <div class="col-sm-4">
                        <div class="mf-single-image align-left ">
                            <span class="thumbnail">
                                {!! get_image_tag($payment_image) !!}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="mf-single-content">
                            {!! clean($payment_content) !!}
                        </div>
                    </div>
                </div>
                <div class="title-footer">
                    <p class="text-center">{!! clean($title_footer) !!}</p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
