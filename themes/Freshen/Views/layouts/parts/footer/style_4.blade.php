<div class="footer_one home4 mt100">
    <div class="container pb70">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="footer_about_widget home2">
                    @if($logo_id = setting_item("freshen_logo_dark"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <div class="logo mb40"><img src="{{$logo}}" alt="{{setting_item("site_title")}}"></div>
                    @endif
                    {!! setting_item_with_lang("freshen_footer_info_text") !!}
                </div>
                <div class="footer_social_widget home2 mt30">
                    <ul class="mb0">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            @if($list_widget_footers = setting_item_with_lang("freshen_list_widget_footer"))
                @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                @foreach($list_widget_footers as $key=>$item)
                    <div class="col-sm-4 col-md-{{ $item->size }} col-lg-{{ $item->size }} col-xl-{{ $item->size }}">
                        <div class="footer_qlink_widget {{ isset($header_style) ? 'home'.$header_style : '' }}">
                            <h4>{{$item->title}}</h4>
                            {!! ($item->content) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <hr>
    <div class="container pt20 pb20">
        <div class="row">
            <div class="col-md-6 col-lg-8 col-xl-9">
                <div class="copyright-widget home2 mb15-767">
                    <p>{!! setting_item('freshen_copyright') !!}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="payment_getway_widget text-end">
                    {!! setting_item('freshen_footer_text_right') !!}
                </div>
            </div>
        </div>
    </div>
</div>
