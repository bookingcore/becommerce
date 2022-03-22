<div class="axtronic-footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @if($footer_info_text = setting_item_with_lang("footer_info_text"))
                    <aside class="address">
                        <a class="text-decoration-none" href="{{url('/')}}">
                            <img src="{{ theme_url('Axtronic/images/logo-white.svg') }}" alt="">
                        </a>
                        <div class="content">
                            {!! clean($footer_info_text) !!}
                        </div>
                    </aside>
                @endif
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="widget-footer">
                    <div class="row">
                        @if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                            @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                            @foreach($list_widget_footers as $key=>$item)
                                <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                    <h5 class="">{{$item->title}}</h5>
                                    {!! ($item->content) !!}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-12">
                <div class="axtronic-form-newsletter">
                    <div class="">
                        <div class="align-content-center align-items-center">
                            <div class="">
                                <h3>{{ __("Newsletter") }}</h3>
                                <p>{{ __("Suaxtronicribe to get information about products and coupons") }}</p>
                            </div>
                            <div class="form-newsletter">
                                <form action="{{ route('newsletter.subscribe') }}" method="post" class="suaxtronicribe-form axtronic-subscribe-form">
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
            {!! setting_item_with_lang("copyright") !!}
        </div>
    </div>
</div>

@include('auth/site-header-action')
