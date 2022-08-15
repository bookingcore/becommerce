<section class="section-newsletter style_1" style="background-image: url(' {{ get_file_url( $image ?? false,'full') }} ')">
    <div class="container">
        <div class="mailchimp_widget">
            @if(!empty($title))
                <div class="box-heading-title text-center mb-xl-3 pb-4">
                    <h2 class="heading-title ">{!! clean($title) !!}</h2>
                    <p class="sub-heading">{!! clean($sub_title) !!}</p>
                </div>
            @endif
            <div class="footer_social_widget">
                <form action="{{ route('newsletter.subscribe') }}" class="footer_mailchimp_form bc-subscribe-form">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="{{ __("Your Email...") }}">
                        <span class="p-0">
                            <button class="btn btn-large" type="submit">
                                <span class="text">{{ $btn_name }}</span>
                                <i class="fa fa-spinner fa-pulse fa-fw d-none icon-loading"></i>
                            </button>
                        </span>
                    </div>
                    <p class="para mt-4 text-center">{{ $content }}</p>
                    <div class="mt-1">
                        <div class="form-mess mt-1 fs-12 "></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
