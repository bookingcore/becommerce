<div class="panel">
    <div class="panel-title"><strong>{{__("Customer")}}</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label >{{__("Select Customer")}}</label>
                    <bc-select2 v-model="customer.id" @settings="custom_select2" placeholder="{{__("-- Please select --")}}"></bc-select2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="mb-3"><strong>{{__("Billing Address")}}</strong></div>
                    <a class="btn btn-default btn-sm" href="#" @click.prevent="editAddress('billing')"><i class="fa fa-edit"></i> {{__("Edit")}}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="mb-3"><strong>{{__("Shipping Address")}}</strong></div>
                    <a class="btn btn-default btn-sm" href="#" @click.prevent="editAddress('shipping')"><i class="fa fa-edit"></i> {{__("Edit")}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
