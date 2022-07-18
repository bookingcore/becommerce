@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="my-3">
            @include('global.breadcrumb')
        </div>
        <div class="store-header">
            <div class="bg-gray-500 px-4 sm:px-6 py-16 lg:px-8 flex items-center justify-between rounded-lg">
                <div class="flex items-center">
                    <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="rounded-full w-24  mr-3">
                    <div>
                        <h3 class="text-white text-lg">{{$user->display_name}}</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <a class="rounded-lg bg-amber-300 px-16 py-3 text-center text-lg font-bold text-" href="#">{{__('Follow')}}</a>
                </div>
            </div>
        </div>
        <div class="my-10">
            <div class="bg-white sticky top-0 z-50 text-base my-5">
                <ul class="flex flex-wrap mr-3 py-3">
                    <li class="mr-5 last:mr-0">
                        <a href="#sectionProduct" class="inline-block rounded-t-lg border-b-2 border-transparent text-gray-600 hover:border-black hover:text-black">{{__("Product")}}</a>
                    </li>
                    <li class="mr-5 last:mr-0">
                        <a href="#sectionAbout" class="inline-block rounded-t-lg border-b-2 border-transparent text-gray-600 hover:border-black hover:text-black " aria-current="page">{{__("About")}}</a>
                    </li>
                    <li class="mr-5 last:mr-0">
                        <a href="#sectionReviews" class="inline-block  rounded-t-lg border-b-2 border-transparent text-gray-600  hover:border-black hover:text-black ">{{__('Reviews')}}</a>
                    </li>
                </ul>
            </div>
            <div id="sectionProduct">
                    <div id="topSellingProduct" class="mb-5">
                        @if(!empty($topSell))
                        <div class="flex items-center">
                            <h3 class="text-xl font-medium mb-5">{{__('Top Selling Products')}}</h3>
                            <div>
                            </div>
                        </div>
                        <div class="list-product bc-carousel" data-owl-item="6">
                            @foreach($topSell as $top)
                                <div class="border p-3">
                                    @include('product.search.loop',['row'=>$top])
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    @include('store.products')
                    <div class="bc-pagination my-5">
                        {{$rows->withQueryString()->links()}}
                    </div>
            </div>
            <div id="sectionAbout" class=" py-10">
                <div class="prose lg:prose-xl">
                    {!! $user->bio !!}
                </div>
            </div>
            <div id="sectionReviews" class=" py-10 ">
                <div class="mt-4">
                    @include('store.reviews')
                </div>
            </div>
        </div>
    </div>
@endsection
