<?php
$location_stocks = $row->location_stocks->keyBy('location_id');
$old = old('location_stocks',$location_stocks);
?>
<div data-condition="is_manage_stock:is(1),product_type:not(external)">
<hr>
<h4 class="mb-3">{{__("Inventory per store locations:")}}</h4>
<div class="form-group-item">
    <div class="g-items-header"  >
        <div class="row grid  grid-cols-12 @if(!empty($tailwind)) gap-4 @endif ">
            <div class="col-md-2 col-span-2">{{__("Location ID")}}</div>
            <div class="col-md-5 col-span-5">{{__("Location")}}</div>
            <div class="col-md-5 col-span-5">{{__("Stock quantity")}}</div>
        </div>
    </div>
    <div class="g-items">
    @foreach(\Modules\Location\Models\Location::query()->where('status','publish')->get() as $location)
        <?php $location_stock = $location_stocks[$location->id] ?? null; ?>
        <div class="item">
            <div class="row grid  grid-cols-12 @if(!empty($tailwind)) gap-4 @endif ">
                <div class="col-md-2 col-span-2">#{{$location->id}}</div>
                <div class="col-md-5 col-span-6">{{$location->name}}</div>
                <div class="col-md-5 col-span-5"><input type="number" step="1" min="0" value="{{$old[$location->id]['quantity'] ?? 0}}" class="form-control" name="location_stocks[{{$location->id}}][quantity]" placeholder="{{__("Stock quantity")}}"></div>
            </div>
        </div>
    @endforeach
    </div>
</div>
</div>
