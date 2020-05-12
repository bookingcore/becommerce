<div class="bravo_HomeFee">
    <div class="martfury-container">
        <div class="martfury-icons-list style-3 columns-5">
            <ul>
            @if(!empty($feeItem))
                @foreach($feeItem as $item)
                    <li class="martfury-icon-box icon_position-left">
                        <div class="mf-icon box-icon">
                            <i class="{{$item['icon'] ?? ''}}"></i>
                        </div>
                        <div class="box-wrapper">
                            <span class="box-title">{{ $item['title'] ?? '' }}</span>
                            <div class="desc">{{$item['sub_title'] ?? ''}}</div>
                        </div>
                    </li>
                    <li class="martfury-icon-box icon-box-step"></li>
                @endforeach
            @endif
            </ul>
        </div>
    </div>
</div>
