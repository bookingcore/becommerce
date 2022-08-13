<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 11:46 PM
 */
?>

<div class="demus-footer" style="background-color: {{setting_item('demus_footer_bg_color')}}">
    <div class="container">
        <div class="footer__top">
            <div class="d-flex justify-content-between">
                <div class=" footer-info pt-2 mb-3 mb-md-4">
                    @if($logo_id = setting_item("demus_logo_footer"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <a href="{{ home_url() }}">
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        </a>
                    @endif
                </div>
                @include("layouts.parts.footer.social")
            </div>
        </div>
        <div class="footer__center-inner style_1">
            <div class="row">
                <div class="col col-md-8 col-lg-7">
                    <div class="widget-footer">
                        <div class="row">
                            @if($list_widget_footers = setting_item_with_lang("demus_list_widget_footer"))
                                @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                                @foreach($list_widget_footers as $key=>$item)
                                    <div class="col col-md-{{ $item->size }} col-lg-{{ $item->size }} col-xl-{{ $item->size }}">
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
                <div class="col col-md-4 col-lg-5">
                    <div class="align-content-center align-items-center form-newsletter" >
                        <div class="d-flex align-items-end flex-column">
                            {!! clean(setting_item("demus_footer_text_subscribe")) !!}
                        </div>
                        <form action="{{ route('newsletter.subscribe') }}" method="post" class="bc-subscribe-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="{{ __("Email address") }}" >
                                <button class="btn btn-large" type="submit">
                                    <span>
                                        {{__('Subcribes')}}
                                        <i class="axtronic-icon-arrow-right"></i>
                                    </span>

                                </button>
                            </div>
                            <div class="form-mess mt-1 fs-12"></div>
                        </form>
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
