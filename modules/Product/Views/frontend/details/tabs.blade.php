<div class="product-tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
            $reviewData = $row->getScoreReview();
            $score_total = $reviewData['score_total'];
        ?>
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
                    <a class="nav-link @if(!$k) active @endif" data-toggle="tab" href="#tab_{{$k}}" role="tab" aria-controls="home" aria-selected="true">{{$review_text}}</a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="tab-content">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <div class="tab-pane fade @if(!$k) show active @endif" id="tab_{{$k}}" role="tabpanel">
                    @if(!empty($tab['content']))
                        {!! clean($tab['content']) !!}
                    @elseif(isset($tab['id']) and view()->exists('Product::frontend.details.tabs.'.$tab['id']))
                        @include('Product::frontend.details.tabs.'.$tab['id'])
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
