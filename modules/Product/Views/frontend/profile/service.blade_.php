<?php
if(!$user->hasPermission('space_create')) return;
$services = \Modules\Product\Models\Product::getVendorServicesQuery($user->id)->orderBy('id','desc')->paginate(10);
?>
@if($services->total())
    <div class="bravo-profile-list-services">
        @include('Product::frontend.blocks.list-product.index', ['rows'=>$services,'style_list'=>empty($view_all) ? 'carousel' : 'normal','desc'=>' ','title'=>__('Space by :name',['name'=>$user->first_name])])

        <div class="container">
            @if(!empty($view_all))
                <div class="review-pag-wrapper">
                    <div class="bravo-pagination">
                        {{$services->appends(request()->query())->links()}}
                    </div>
                    <div class="review-pag-text text-center">
                        {{ __("Showing :from - :to of :total total",["from"=>$services->firstItem(),"to"=>$services->lastItem(),"total"=>$services->total()]) }}
                    </div>
                </div>
            @else
                <div class="text-center mt30"><a class="btn btn-sm btn-primary" href="{{route('user.profile.services',['id'=>$user->id,'type'=>'space'])}}">{{__('View all (:total)',['total'=>$services->total()])}}</a></div>
            @endif
        </div>
    </div>
@endif
