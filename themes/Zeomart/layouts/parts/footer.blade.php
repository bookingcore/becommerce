<div class="bc-newsletter mt-5">
    <div class="max-w-7xl m-auto">
        <div class="bc-form-newsletter">
            <div class="text-center">
                <div class="w-full text-[28px] mb-3">
                    {{ __("Subscribe and get 20% discount.") }}
                </div>
                <div class="w-full">
                    <form action="{{ route('newsletter.subscribe') }}" method="post" class="subcribe-form bc-subscribe-form">
                        @csrf
                        <div class="flex justify-center">
                            <input type="text" class="text-[15px] min-w-[400px] py-4 px-4 border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500 rounded" name="email" placeholder="{{ __("Email address") }}" >
                            <button type="submit" class="inline-flex ml-3 items-center px-8 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-[#F5C34B] text-[#041E42]">
                                <svg class="hidden motion-reduce:hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ __("Subscribe") }}
                            </button>
                        </div>
                        <div class="form-mess mt-2 text-pink-600 text-sm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="max-w-7xl m-auto">
    <div class="py-10">
        <div class="flex flex-wrap">
            <div class="w-1/4">
                @if($footer_info_text = setting_item_with_lang("zeomart_footer_info_text"))
                    {!! ($footer_info_text) !!}
                @endif
            </div>
            <div class="w-3/4">
                <div class="flex">
                    @if($list_widget_footers = setting_item_with_lang("zeomart_list_widget_footer"))
                        @php $list_widget_footers = json_decode($list_widget_footers); @endphp
                        @foreach($list_widget_footers as $key=>$item)
                            <div class="w-{{ $item->size }}/4">
                                <div class="text-lg font-medium mb-6">
                                    {{$item->title}}
                                </div>
                                <div class="mb-4">
                                    {!! ($item->content) !!}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="flex justify-between py-4 my-4 border-t">
            {!! setting_item_with_lang("zeomart_copyright") !!}
            <div class="payment_getway_widget text-end">
                {!! setting_item_with_lang('zeomart_footer_text_right') !!}
            </div>
        </div>
    </div>
</div>

{{--@include('auth/login-register-modal')--}}
