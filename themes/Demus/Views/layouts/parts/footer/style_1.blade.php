<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 11:45 PM
 */
?>

<div class="axtronic-footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                <aside class="address">
                    @if($logo_id = setting_item("demus_logo_dark"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <a href="{{ home_url() }}">
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        </a>
                    @endif
                    <div class="content">
                        {!! clean(setting_item('demus_footer_info_text')) !!}
                    </div>
                </aside>
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="widget-footer">
                    <div class="row">
                        @if($list_widget_footers = setting_item_with_lang("demus_list_widget_footer"))
                            @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                            @foreach($list_widget_footers as $key=>$item)
                                <div class="col-sm-{{ $item->size }} col-md-{{ $item->size }} col-lg-{{ $item->size }} col-xl-{{ $item->size }}">
                                    <div class="footer_qlink_widget">
                                        <h5>{{$item->title}}</h5>
                                        {!! ($item->content) !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-12">
                <div class="demus-form-newsletter">
                    <div class="">
                        <div class="align-content-center align-items-center">
                            <div class="">
                                {!! setting_item("demus_footer_text_subscribe") !!}
                            </div>
                            <div class="form-newsletter">
                                <form action="{{ route('newsletter.subscribe') }}" method="post" class="subscribe-form bc-subscribe-form ">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="{{ __("Email address") }}" >
                                        <button class="btn" type="submit">
                                            <i class="axtronic-icon-arrow-right"></i>
                                        </button>
                                    </div>
                                    <div class="form-mess mt-1 fs-12"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="back2top"><i class="icon icon-arrow-up"></i></div>

<div class="container">
    <div class="copy-right">
        <div class="">
            {!! setting_item("axtronic_copyright") !!}
        </div>
    </div>
</div>

@include('auth/site-header-action')
