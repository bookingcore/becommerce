<div class="dividers pt15 pb15 bgc-f5">
    <div class="container">
        <div class="feature_icons bgc-white p30">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="mailchimp_widget home2 mb30-md">
                        <div class="icon float-start"><span class="flaticon-email-1"></span></div>
                        <div class="details">
                            <h3 class="title">{{ $title }}</h3>
                            <p class="para">{{ $sub_title }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="footer_social_widget">
                        <form action="{{ route('newsletter.subscribe') }}" class="footer_mailchimp_form bc-subscribe-form home2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <input type="email" class="form-control" placeholder="{{ __("Your Email...") }}">
                                    <button class="btn miw-120 btn-primary d-flex align-items-center" type="submit">{{ $btn_name }}
                                        <i class="fa fa-spinner fa-pulse fa-fw d-none"></i></button>
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
    </div>
</div>
