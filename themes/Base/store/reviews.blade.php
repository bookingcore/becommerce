@if($rows->total())
    <div class="bc-review-list">
        @if($rows)
            @foreach($rows as $item)
                @php $userInfo = $item->author; if(!$userInfo){ continue; }@endphp
                <div class="review-item border-bottom pt-2 pb-2 mb-3 fs-14">
                    <div class="d-flex align-items-start">
                        <img class="flex-shrink-0 me-3 rounded-circle w-75px h-75px" src="{{$userInfo->avatar_url}}" alt="{{$userInfo->display_name}}">
                        <div>
                            <p class="mb-1 fs-16">{{$userInfo->display_name}} - {{display_datetime($item->created_at)}}</p>
                            @if($item->rate_number)
                                <div class="d-flex mb-2">
                                    @for( $i = 0 ; $i < 5 ; $i++ )
                                        @if($i < $item->rate_number)
                                            <i class="fa fa-star me-2 c-fcb800"></i>
                                        @else
                                            <i class="fa fa-star-o me-2"></i>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                            <h5 class="mb-0 fs-18"> {{$item->title}} </h5>
                            <p>
                                {{$item->content}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="mb-2">
        {{ __("Showing :from - :to of :total total",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}
    </div>
    <div class="bravo-pagination">
        {{$rows->appends(request()->query())->links()}}
    </div>
@else
    <div class="alert alert-warning" role="alert">{{__("No Review")}}</div>
@endif
