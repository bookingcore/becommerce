@if(!empty($list_items))
<div class="axtronic-site-features">
    <div class="container">
        <div class="row">
            @foreach($list_items as $item)
            <div class="col-xl-3 col-lg-6 col-sm-6  mb-xl-0 mb-4">
                <div class="d-flex align-items-center justify-content-center box">
                    <div class="item-icon">
                        <i class="{{$item['icon'] ?? 'axtronic-icon-group'}}"></i>
                    </div>
                    <div class="ms-3">
                        <h4 >{{ $item['title'] ?? '' }}</h4>
                        <p class="mb-0">{{$item['sub_title'] ?? ''}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
