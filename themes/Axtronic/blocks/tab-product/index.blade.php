<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/14/2022
 * Time: 10:04 AM
 */
?>
<section class="featured-product pb-5">
    <div class="container">
        @if(!empty($title))
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>{!! clean($title) !!}</h2>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_listing_tabs {{$style_list}}">
                    <!-- Nav tabs -->
                    <div class="nav nav-tabs {{$style_list == 'style_1'? "justify-content-start":"justify-content-center"}}" role="tablist">
                        @if(!empty($list_featured))
                            <button class="nav-link active" id="nav-shopping-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-featured" role="tab" aria-controls="nav-cat-featured" aria-selected="false">
                                {{ __("Featured") }}
                            </button>
                        @endif
                        @if(!empty($list_latest))
                            <button class="nav-link " id="nav-shopping-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-latest" role="tab" aria-controls="nav-cat-latest" aria-selected="false">
                                {{ __("Latest") }}
                            </button>
                        @endif
                        @if(!empty($list_rate))
                            <button class="nav-link " id="nav-shopping-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-rate" role="tab" aria-controls="nav-cat-rate" aria-selected="false">
                                {{ __("Top Rated") }}
                            </button>
                        @endif
                    </div>
                <!-- Tab panes -->
                    <div class="tab-content" id="nav-tabContent">
                        @if(!empty($list_featured))
                            <div class="tab-pane fade active show" id="nav-cat-featured" role="tabpanel" aria-labelledby="nav-cat-featured-tab">
                                <div class="popular_listing_slider1">
                                    <div class="row">
                                        @foreach($list_featured as $item)
                                            <div class="col-sm-3">
                                                @include('product.search.loop',['row'=>$item])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($list_latest))
                            <div class="tab-pane fade" id="nav-cat-latest" role="tabpanel" aria-labelledby="nav-cat-latest-tab">
                                <div class="popular_listing_slider1">
                                    <div class="row">
                                        @foreach($list_latest as $item)
                                            <div class="col-sm-3">
                                                @include('product.search.loop',['row'=>$item])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($list_rate))
                            <div class="tab-pane fade" id="nav-cat-rate" role="tabpanel" aria-labelledby="nav-cat-rate-tab">
                                <div class="popular_listing_slider1">
                                    <div class="row">
                                        @foreach($list_rate as $item)
                                            <div class="col-sm-3">
                                                @include('product.search.loop',['row'=>$item])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
