<div class="bc-newsletter">
    <div class="container">
        <div class="bc-form-newsletter">
            <div class="row align-content-center align-items-center">
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <h3>{{ __("Newsletter") }}</h3>
                    <p>{{ __("Subcribe to get information about products and coupons") }}</p>
                </div>
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bc-subscribe-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="{{ __("Email address") }}" >
                            <button class="btn miw-120 btn-primary" type="submit">
                                {{ __("Subscribe") }}
                                <i class="fa fa-spinner fa-pulse fa-fw"></i>
                            </button>
                        </div>
                        <div class="form-mess mt-1 fs-12"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="back2top"><i class="icon icon-arrow-up"></i></div>

<div class="container">
    <footer class="py-5">
        <div class="row">
            @if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                @foreach($list_widget_footers as $key=>$item)
                    <div class="col-lg-2 col-sm-12 mb-4 mb-lg-0">
                        <h5 class="font-21 mb-3">{{$item->title}}</h5>
                        {!! ($item->content) !!}
                    </div>
                @endforeach
            @endif
            @if($footer_info_text = setting_item_with_lang("footer_info_text"))
                <div class="col-lg-4 col-sm-12 offset-md-1">
                    <h5 class="font-21 mb-3">{{ __("Contact us") }}</h5>
                    <div class="content">
                        {!! clean($footer_info_text) !!}
                    </div>
                </aside>
            @endif
        </div>
        <div class="d-flex justify-content-between py-4 my-4 border-top">
            {!! setting_item_with_lang("copyright") !!}
        </div>
    </footer>
</div>

@include('auth/login-register-modal')
