<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product relative border h-full p-4 {{$class ?? ""}} group overflow-hidden">
    <div class="mb-5">
        <a href="{{$row->getDetailUrl()}}" class="mi-h-230 relative overflow-hidden block">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'w-full']) !!}
            <button type="button" class="translate-y-full group-hover:translate-y-0 opacity-0 actions absolute bottom-0 w-full group-hover:opacity-100 transition-all duration-300 focus:outline-none bg-[#F5C34B] hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-3.5">
                {{__('View Detail')}}
            </button>
        </a>
        <div class="opacity-0 actions absolute top-0 right-0 py-3 px-4 group-hover:opacity-100 transition-all duration-300 translate-x-full group-hover:translate-x-0">
            <div class="service-wishlist is_loop {{$row->isWishList()}} w-9 h-9 border flex items-center justify-center rounded-full cursor-pointer bg-white hover:bg-[#F5C34B] transition-all duration-300" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}">
                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.63541 0.584717C11.522 0.584717 13.051 2.13723 13.051 4.31075C13.051 8.65777 8.39345 11.1418 6.84094 12.0733C5.2884 11.1418 0.630859 8.65777 0.630859 4.31075C0.630859 2.13723 2.18337 0.584717 4.04638 0.584717C5.20145 0.584717 6.2199 1.20572 6.84094 1.82673C7.46188 1.20572 8.48036 0.584717 9.63541 0.584717V0.584717ZM7.42094 10.2749C7.96799 9.92963 8.46174 9.58621 8.92377 9.21857C10.775 7.74679 11.8089 6.13835 11.8089 4.31075C11.8089 2.84518 10.8545 1.82673 9.63541 1.82673C8.96719 1.82673 8.24436 2.1807 7.71897 2.70483L6.84094 3.58293L5.9628 2.70483C5.43744 2.1807 4.71459 1.82673 4.04638 1.82673C2.84163 1.82673 1.87287 2.85511 1.87287 4.31075C1.87287 6.13901 2.90746 7.74679 4.75744 9.21857C5.22008 9.58621 5.71378 9.92963 6.26089 10.2743C6.44654 10.3917 6.63039 10.504 6.84094 10.6295C7.05141 10.504 7.23527 10.3917 7.42094 10.2749V10.2749Z" fill="#041E42"/>
                </svg>
            </div>
            <div class="bc-compare mt-1 w-9 h-9 border flex items-center justify-center rounded-full cursor-pointer bg-white hover:bg-[#F5C34B] transition-all duration-300" data-bs-toggle="tooltip" title="{{ __("Compare") }}" data-id="{{$row->id}}">
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.5625 10.6243H13.2818V0.941406C13.2818 0.699799 13.0859 0.503906 12.8443 0.503906H10.1757C9.93411 0.503906 9.73822 0.699799 9.73822 0.941406V10.6243H8.7719V2.983C8.7719 2.74139 8.576 2.5455 8.3344 2.5455H5.66582C5.42421 2.5455 5.22832 2.74139 5.22832 2.983V10.6243H4.26199V5.0247C4.26199 4.7831 4.0661 4.5872 3.82449 4.5872H1.15591C0.914307 4.5872 0.718414 4.7831 0.718414 5.0247V10.6243H0.4375C0.195892 10.6243 0 10.8202 0 11.0618C0 11.3034 0.195892 11.4993 0.4375 11.4993H13.5625C13.8041 11.4993 14 11.3034 14 11.0618C14 10.8202 13.8041 10.6243 13.5625 10.6243ZM10.6131 1.37891H12.4067V10.6243H10.6131V1.37891ZM6.10332 10.6243V3.4205H7.8969V10.6243H6.10332ZM1.59341 5.4622H3.38699V10.6243H1.59341V5.4622Z" fill="#041E42"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($row->brand)
            <div class="mt-2 mb-2"><a class="text-sm color-[#626974] uppercase" href="{{$row->brand->getDetailUrl()}}">{{$row->brand->name}}</a></div>
        @endif
        <a class="text-base font-[500]" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        @if(!empty($reviewData['total_review']))
            <div class="card-rating mb-2 flex mt-2 items-center">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                <span class="text-[#626974] ml-3">{{$reviewData['total_review']}}
                    @if($reviewData['total_review'] > 1)
                        {{ __("Reviews") }}
                    @else
                        {{ __("Review") }}
                    @endif
                </span>
            </div>
        @endif
        <div class="card-price flex items-center">
            @include('product.details.price')
            <div class="ml-3 text-[#443297]">
                @if($row->stock_status == "in")
                    @if(!empty($row->discount_percent))
                        <div class="badge">{{$row->discount_percent}}{{ __("% Off") }}</div>
                    @endif
                @else
                    <span class="badge out-stock">{{__('Out Of Stock')}}</span>
                @endif
            </div>
        </div>
    </div>
</div>
