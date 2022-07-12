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
                    <div class="flex flex-wrap ">
                        @foreach($rows as $row)
                            <div class="w-1/4 border -ml-[1px] -mb-[1px]">
                                @include('blocks.list-category-product.loop-style-2')
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach($categories as $item)
                    <div class="hidden" id="zm-tab-{{ $item->id.$id }}"  role="tabpanel">
                        <div class="flex flex-wrap">
                            @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                            @if(!empty($list_items))
                                @foreach($list_items as $row)
                                    <div class="w-1/4 border -ml-[1px] -mb-[1px]">
                                        @include('blocks.list-category-product.loop-style-2')
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

