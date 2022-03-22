<?php
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="axtronic-tab-root">
    <ul class="nav nav-tabs axtronic-tab-list">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                @php $tab_name = $tab['name'] @endphp
                @if($tab['id'] == 'review')
                    @php
                        $count = (!empty($review_list)) ? $review_list->total() : 0;
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
