@extends('layouts.vendor')
@section('content')
<section class="bc-items-listing">
    <div class="flex justify-between mb-16">
        <h1 class="text-3xl font-medium">{{$page_title ?? ''}}</h1>
    </div>

    @include('global.message')

    <div class="panel">
        <div class="py-1">
            @include('vendor.review.filter')
        </div>
        <div class="bc-section__content">
            <div class="table-responsive mih-300">
                <table class="table bc-table text-[15px] w-full" cellspacing="0" cellpadding="0">
                    <thead class="bg-[#F3F5F6]">
                    <tr>
                        <th class="p-3 py-4 rounded-l-md font-medium">{{__('Author')}}</th>
                        <th>{{__('Review Content')}}</th>
                        <th>{{__('In Response To')}}</th>
                        <th>{{__('Status')}}</th>
                        <th class="p-3 rounded-r-md font-medium">{{__('Submitted On')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        @php $service = $row->getService @endphp
                        <tr>
                            <td>
                                @if(!empty( $metaUser =  $row->getUserInfo))
                                    {{ $metaUser->email ?? 'Email' }}
                                @else
                                    {{__("[Author Deleted]")}}
                                @endif
                            </td>
                            <td>
                                <strong>{{$row->title}}</strong>
                                <p>{{$row->content}}</p>
                                @if($row->rate_number)
                                    <ul class="review-star left flex items-center">
                                        @for( $i = 0 ; $i < 5 ; $i++ )
                                            @if($i < $row->rate_number)
                                                <li><i class="fa fa-star text-yellow-500"></i></li>
                                            @else
                                                <li><i class="fa fa-star-o text-slate-300"></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                @endif
                                @if(!empty($service) and !empty($allReviewStats = $service->getReviewStats()))
                                    @if(!empty($metaReviews = $row->getReviewMeta()))
                                        <a class="btn-show-info-review right" data-toggle="collapse" href="#review-{{$row->id}}">
                                            {{__("More info")}}
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <div class="collapse" id="review-{{$row->id}}">
                                            <div class="review-items">
                                                <div class="row">
                                                    @foreach($metaReviews as $metaReview)
                                                        @if( in_array($metaReview->name , $allReviewStats))
                                                            <div class="item col-md-12 d-flex">
                                                                <label style="margin-right: 15px;">{{$metaReview->name}}</label>
                                                                <ul class="review-star flex items-center">
                                                                    @for( $i = 0 ; $i < 5 ; $i++ )
                                                                        @if($i < $metaReview->val)
                                                                            <li><i class="fa fa-star"></i></li>
                                                                        @else
                                                                            <li><i class="fa fa-star-o"></i>
                                                                            </li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(!empty($service))
                                    <a href="{{$service->getDetailUrl()}}">
                                        {{ $service->title }}
                                    </a>
                                    <p>
                                        <a target="_blank" href="{{$service->getDetailUrl()}}">
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{ __("View :name",["name"=>$service->getModelName() ])}}
                                        </a>
                                    </p>
                                @else
                                    {{__("[Deleted]")}}
                                @endif
                            </td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            <td>{{ display_datetime($row->updated_at)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(!count($rows))
                <div class="alert alert-warning">{{__("No data found")}}</div>
            @endif
            <div class="p-3">{{$rows->appends(request()->query())->links()}}</div>
        </div>
    </div>
</section>
@endsection
