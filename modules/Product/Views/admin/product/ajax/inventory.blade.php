<?php
$location_stocks = $variation->location_stocks->keyBy('location_id');
$old = $location_stocks;
?>
<div v-condition="is_manage_stock:is(1)">
<hr>
<h4 class="mb-3">{{__("Inventory per store locations:")}}</h4>
<div class="form-group-item">
    <div class="g-items-header"  >
        <div class="row grid  grid-cols-12 @if(!empty($tailwind)) gap-4 @endif ">
            <div class="col-md-7 col-span-7">{{__("Location")}}</div>
            <div class="col-md-5 col-span-5">{{__("Stock quantity")}}</div>
        </div>
    </div>
    <div class="g-items">
    @foreach(\Modules\Location\Models\Location::getActive() as $location)
        <?php $location_stock = $location_stocks[$location->id] ?? null; ?>
        <div class="item">
            <div class="row grid  grid-cols-12 @if(!empty($tailwind)) gap-4 @endif  ">
                <div class="col-md-2 col-span-2">#{{$location->id}}</div>
                <div class="col-md-5 col-span-5">{{$location->name}}</div>
                <div class="col-md-5 col-span-5"><input type="number" step="1" min="0" value="{{$old[$location->id]['quantity'] ?? 0}}" class="form-control" name="variations[{{$variation->id}}][location_stocks][{{$location->id}}][quantity]" placeholder="{{__("Stock quantity")}}"></div>
            </div>
        </div>
    @endforeach
    </div>
</div>
</div>
