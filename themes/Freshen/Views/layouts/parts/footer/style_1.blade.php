<section class="footer_one footer_about_widget">
    <div class="footer_top_img"></div>
    @if(!empty($bg_footer = setting_item('freshen_footer_bg_image')))
        <div class="footer_bg_img" style="background-image: url('{{ get_file_url($bg_footer,'full') }}')"></div>
    @endif
    <div class="container pb70">
        <div class="bc-newsletter">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                        <div class="mailchimp_widget mb30-md">
                            <div class="icon float-start"><span class="flaticon-email-1"></span></div>
                            <div class="details">
                                <h3 class="title">{{ __('SIGN UP FOR NEWSLETTER') }}</h3>
                                <p class="para">{{ __("Subscribe to the weekly newsletter for all the latest updates") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-5">
                        <div class="footer_social_widget">
                            <form action="{{ route('newsletter.subscribe') }}" class="footer_mailchimp_form bc-subscribe-form">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <input type="email" class="form-control" name="email" placeholder="{{ __("Your Email...") }}" >
                                        <button class="btn miw-120 btn-primary d-flex align-items-center" type="submit">
                                            {{ __("Subscribe") }}
                                            <i class="fa fa-spinner fa-pulse fa-fw d-none"></i>
                                        </button>
                                    </div>
                                    <div class="mt-1">
                                        <div class="form-mess mt-1 fs-12"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row mt100">
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="footer_about_widget">
                    <div class="logo mb40">
                        @if($logo_id = setting_item("freshen_logo_light"))
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <a href="{{ home_url() }}">
                                <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                            </a>
                        @endif
                    </div>
                </div>
                {!! setting_item_with_lang("freshen_footer_info_text") !!}
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
                <div class="copyright-widget mb15-767">
                    <p>
                        {!! setting_item_with_lang('freshen_copyright') !!}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="payment_getway_widget text-end">
                    {!! setting_item_with_lang('freshen_footer_text_right') !!}
                </div>
            </div>
        </div>
    </div>
</section>
