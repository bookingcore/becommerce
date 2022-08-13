<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/13/2022
 * Time: 4:20 PM
 */
?>
<div class="row g-4 g-xl-5 sidebarleft">
    <div class="collection-sidebar sidebar-left col-12 col-lg-3">
        @include("product.sidebar")
    </div>
    <div class="collection-content col-12 col-lg-9">
        @include("product.search.header")
        <div class="row py-3">
            @if($rows->total())
                @foreach($rows as $row)
                    @if($listing_list_style=='list')
                        <div class="col-12">
                            @includeIf("product.search.loop-list")
                        </div>
                    @else
                        <div class="col-sm-4 mb-3">
                            @include("product.search.loop")
                        </div>
                    @endif

                @endforeach
            @else
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                        {{__("No Product")}}
                    </div>
                </div>
            @endif
        </div>
        <div class="bc-pagination mb-5">
            {{$rows->withQueryString()->links()}}
        </div>
    </div>
</div>
