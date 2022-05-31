@extends('layouts.vendor')
@section('content')
<section class="bc-items-listing">
    <div class="d-flex justify-content-between mb-4">
        <h1>{{$page_title ?? ''}}</h1>
    </div>

    @include('global.message')

    <div class="panel">
        <div class="px-3">
            @include('vendor.review.filter')
        </div>
        <div class="bc-section__content">
            <div class="table-responsive">
                <table class="table bc-table">
                    <thead>
                    <tr>
                        <th>{{__('Author')}}</th>
                        <th>{{__('Review Content')}}</th>
                        <th>{{__('In Response To')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Submitted On')}}</th>
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
                                    <ul class="review-star left">
                                        @for( $i = 0 ; $i < 5 ; $i++ )
                                            @if($i < $row->rate_number)
                                                <li><i class="fa fa-star"></i></li>
                                            @else
                                                <li><i class="fa fa-star-o"></i></li>
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
                                                                <ul class="review-star">
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
            {{$rows->appends(request()->query())->links()}}
        </div>
    </div>
</section>
@endsection
