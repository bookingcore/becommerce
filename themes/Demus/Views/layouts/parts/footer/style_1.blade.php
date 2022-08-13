<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 11:45 PM
 */
?>

<div class="demus-footer style_1" style="background-color: {{setting_item('demus_footer_bg_color')}}">
    <div class="container">
        <div class="footer__center-inner ">
            <div class="row g-2 g-lg-2">
                <div class="col col-md-4 col-lg-5">
                    <aside class="address">
                        <div class="footer-info pt-2 mb-3 mb-md-4">
                            @if($logo_id = setting_item("demus_logo_footer"))
                                <?php $logo = get_file_url($logo_id,'full') ?>
                                <a href="{{ home_url() }}">
                                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                                </a>
                            @endif
                        </div>
                        <div class="content ">
                            {!! clean(setting_item('demus_footer_info_text')) !!}
                        </div>
                        @include("layouts.parts.footer.social")
                    </aside>
                </div>
                <div class="col col-md-8 col-lg-7">
                    <div class="widget-footer">
                        <div class="row">
                            @if($list_widget_footers = setting_item_with_lang("demus_list_widget_footer"))
                                @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                                @foreach($list_widget_footers as $key=>$item)
                                    <div class="col-sm-{{ $item->size }} col-md-{{ $item->size }} col-lg-{{ $item->size }} col-xl-{{ $item->size }}">
                                        <div class="footer_qlink_widget">
                                            <h6>{{$item->title}}</h6>
                                            {!! ($item->content) !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-8 col-xl-9">{!! setting_item("demus_copyright") !!}</div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="payment_getway_widget text-end">
                        {!! setting_item('demus_footer_text_right') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




