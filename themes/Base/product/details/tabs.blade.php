<?php
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-tab-root">
    <ul class="nav nav-pills bc-tab-list mb-3">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                @php $review_text = $tab['name'] @endphp
                @if($tab['id'] == 'review')
                    @php
                        $count = (!empty($review_list)) ? $review_list->total() : 0;
                        $review_text = $tab['name']." ($count)";
                    @endphp
                @endif
                <li class="nav-item">
                    <a class="nav-link @if(!$k) active @endif" data-tab="tab_{{$k}}" aria-current="page" href="#">{{ $review_text }}</a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="bc-tabs">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <div class="bc-tab @if(!$k) active @endif" id="tab_{{$k}}" role="tabpanel">
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
