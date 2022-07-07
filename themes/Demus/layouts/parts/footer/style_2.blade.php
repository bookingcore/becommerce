<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 11:46 PM
 */
?>
<div class="axtronic-form-newsletter style-2">
    <div class="container">
        <div class="align-content-center align-items-center form-newsletter" style="background-image: url('{{ get_file_url(setting_item('axtronic_footer_bg_image'),'full') }}')">
            <div class="d-flex align-items-center flex-column">
                {!! clean(setting_item("axtronic_footer_text_subscribe")) !!}
            </div>
            <form action="{{ route('newsletter.subscribe') }}" method="post" class="suaxtronicribe-form axtronic-subscribe-form">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="email" placeholder="{{ __("Email address") }}" >
                    <button class="btn" type="submit">
                        <span>{{__('Subcribes')}}</span>
                        <i class="axtronic-icon-arrow-right"></i>
                    </button>
                </div>
                <div class="form-mess mt-1 fs-12"></div>
            </form>
        </div>
    </div>
</div>
<div class="axtronic-footer">

    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-12">
                <aside class="address">
                    @if($logo_id = setting_item("axtronic_logo_light"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <a href="{{ home_url() }}">
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        </a>
                    @endif
                    <div class="content">
                        {!! clean(setting_item('axtronic_footer_info_text')) !!}
                    </div>
                </aside>
            </div>
            <div class="col-xl-7 col-sm-12">
                <div class="widget-footer">
                    <div class="row">
                        @if($list_widget_footers = setting_item_with_lang("axtronic_list_widget_footer"))
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
