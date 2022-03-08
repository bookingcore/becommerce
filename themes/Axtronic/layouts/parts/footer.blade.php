<div class="bc-footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @if($footer_info_text = setting_item_with_lang("footer_info_text"))
                    <div class="address">
                        <!-- <h5 class="font-21 mb-3">{{ __("Contact us") }}</h5> -->
                        <div class="content">
                            {!! clean($footer_info_text) !!}
                        </div>
                    </aside>
                @endif
                </div>
            </div>
            <div class="col-xl-5 col-sm-12">
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
            <div class="col-xl-4 col-sm-12">
                <div class="bc-form-newsletter">
                    <div class="">
                        <div class="align-content-center align-items-center">
                            <div class="">
                                <h3>{{ __("Newsletter") }}</h3>
                                <p>{{ __("Subcribe to get information about products and coupons") }}</p>
                            </div>
                            <div class="form-newsletter">
                                <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bc-subscribe-form">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="{{ __("Email address") }}" >
                                        <button class="btn miw-120 btn-primary" type="submit">
                                            
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
    </footer>
</div>

@include('auth/login-register-modal')
