<div class="form-group-item bg-white">
    <div class="g-items-header">
        <div class="row">
            <div class="col-md-5">{{__("Product")}}</div>
            <div class="col-md-2">{{__("Qty")}}</div>
            <div class="col-md-2">{{__("Price")}}</div>
            <div class="col-md-2">{{__("Total")}}</div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <div class="g-items">
        <bc-order-item v-for="(item,index) in items" :key="key" :item="item" @del="delItem"></bc-order-item>
        <div class="item" style="background: #f7f7f7;">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="col-8 text-right ">{{__("Subtotal")}}</div>
                        <div class="col-4 text-right font-weight-bold">@{{ formatMoney(subtotal) }}</div>
                    </div>
                    <div class="d-flex">
                        <div class="col-8 text-right ">{{__("Grand total")}}</div>
                        <div class="col-4 text-right font-weight-bold">@{{ formatMoney(total) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item" style="background: #f7f7f7;">
            <div class="row">
                <div class="col-md-12 text-right">
                    <span class="btn btn-info btn-sm " @click="addItem"><i class="icon ion-ios-add-circle-outline"></i> {{__("Add item")}}</span>
                </div>
            </div>
        </div>

    </div>

</div>
