@if(!empty($categories))
    @php $id = rand() @endphp
    <div class="zm-list-category-product py-10">
        <div class="max-w-7xl m-auto">
            <div class="mb-8 flex justify-between items-center">
                <h3 class="font-[500] text-3xl">{{ $title }}</h3>
                <div class="flex" data-tabs-toggle="#zm-tab-toggle-{{ $id }}">
                    @if(!empty($categories))
                        @foreach($categories as $item)
                            @php if(empty($list_product_cat[ $item->id ]->count())) continue @endphp
                            <button data-tabs-target="#zm-tab-{{ $item->id.$id }}" aria-controls="zm-tab-{{ $item->id.$id }}" role="tab" aria-selected="false" class="font-[500] text-base relative pb-1 ml-4 ">
                                {{ $item->translate()->name }}
                            </button>
                        @endforeach
                    @endif
                    <button data-tabs-target="#zm-tab-all-{{$id}}" aria-controls="zm-tab-all" role="tab" aria-selected="false" class="font-[500] text-base relative pb-1 ml-4">
                        {{ __("All") }}
                    </button>
                </div>
            </div>
            <div class="bc-content" id="zm-tab-toggle-{{ $id }}">
                <div class="hidden" id="zm-tab-all-{{$id}}"  role="tabpanel">
                    <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach($rows as $row)
                            @include('product.search.loop')
                        @endforeach
                    </div>
                </div>
                @foreach($categories as $item)
                    <div class="hidden" id="zm-tab-{{ $item->id.$id }}"  role="tabpanel">
                        @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                        <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                            @if(!empty($list_items))
                                @foreach($list_items as $row)
                                    @include('product.search.loop',['row'=>$row])
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

