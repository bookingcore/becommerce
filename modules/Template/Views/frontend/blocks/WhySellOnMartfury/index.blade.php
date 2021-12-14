<div class="bravo_whySellOnBecommerce">
    <div class="container">
        <h4 class="bravo-header-title mf-semi-bold">{{$title}}</h4>

        <h2 class="mf-regular bravo-sub-title">{{$content}}</h2>

        <div class="row">
            @if(!empty($item))
                @foreach($item as $value)
                    <div class="col-md-4">
                        <div class="wpb_wrapper">
                            <div class="martfury-icon-box icon_position-top-center text_left ">
                                <div class="mf-icon-area box-img">
                                    {!! get_image_tag($value['icon_image']) !!}
                                </div>
                                <div class="box-wrapper">
                                    <h3 class="box-title">
                                        <a href="{{$value['sub_link']}}" title="Learn More">{{$value['title']}}</a>
                                    </h3>
                                    <div class="desc">
                                        {!! clean($value['sub_title']) !!}
                                    </div>
                                    <a href="{{$value['sub_link']}}" title="Learn More" class="box-url">{{$value['link_title']}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
