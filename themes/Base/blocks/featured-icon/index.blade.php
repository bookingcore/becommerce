@if(!empty($list_items))
    <div class="bc-site-features pt-5 pb-5">
        <div class="container">
            <div class="row">
                @foreach($list_items as $item)
                    <div class="col-xl-3 col-lg-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="d-flex align-items-center box">
                            <div class="flex-shrink-0">
                                <div class="round bg-main c-white d-flex align-items-center justify-content-center">
                                    <i class="fs-32 {{$item['icon'] ?? 'fa fa-configs'}}"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="fs-23">{{ $item['title'] ?? '' }}</h4>
                                <p class="mb-0">{{$item['sub_title'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
