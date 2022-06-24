<div class="shop_single_tab_content mt30">
    <ul class="nav nav-tabs justify-content-center" id="myTab2" role="tablist">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                @php $tab_name = $tab['name'] @endphp
                @if($tab['id'] == 'review')
                    @php
                        $review_score = $row->review_data;
                        $count = $review_score['total_review'];
                        $tab_name = $tab['name']." ($count)";
                    @endphp
                @endif
                <li class="nav-item">
                    <button type="button" id="tab-{{ $tab['id'] }}" class="nav-link @if(!$k) active @endif tab-{{ $tab['id'] }}" data-bs-toggle="tab" data-bs-target="#tab_{{$k}}" aria-current="page" href="#tab_{{$k}}">{{ $tab_name }}</button>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="tab-content" id="myTabContent2">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <div class="tab-pane fade @if(!$k) show active @endif" id="tab_{{$k}}" role="tabpanel">
                    @if(!empty($tab['content']))
                        {!! clean($tab['content']) !!}
                    @elseif(isset($tab['id']) and view()->exists('product.details.tabs.'.$tab['id']))
                        @include('product.details.tabs.'.$tab['id'])
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>


<div class="bc-tab-root d-none">
    <ul class="nav nav-tabs bc-tab-list">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                @php $tab_name = $tab['name'] @endphp
                @if($tab['id'] == 'review')
                    @php
                        $count = $row->review_list_count;
                        $tab_name = $tab['name']." ($count)";
                    @endphp
                @endif
                <li class="nav-item">
                    <a id="tab-{{ $tab['id'] }}" class="nav-link @if(!$k) active @endif tab-{{ $tab['id'] }}" data-bs-toggle="tab" data-bs-target="#tab_{{$k}}" aria-current="page" href="#tab_{{$k}}">{{ $tab_name }}</a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="tab-content">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <div class="tab-pane border rounded p-3 @if(!$k) active @endif" id="tab_{{$k}}" role="tabpanel">
                    @if(!empty($tab['content']))
                        {!! clean($tab['content']) !!}
                    @elseif(isset($tab['id']) and view()->exists('product.details.tabs.'.$tab['id']))
                        @include('product.details.tabs.'.$tab['id'])
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
