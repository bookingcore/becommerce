@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{$order->id ? __("Edit Order: #:order_id",['order_id'=>$order->id]) : __("Create new order")}}</h1>
        </div>
        @include('Layout::admin.message')
        <div class="row" id="bc_order_form" v-cloak>
            <div class="col-md-9">
                @include('Order::admin.order.detail.customer')
                @include('Order::admin.order.detail.items')
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-title"><strong>{{__("Publish")}}</strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label >{{__("Status")}}</label>
                            <select v-model="status" class="form-select form-control">
                                @foreach($statues as $status_id=>$text)
                                    <option value="{{$status_id}}">{{$text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >{{__("Order date")}}</label>
                            <bc-datepicker v-model="created_at" :settings="created_at_settings"></bc-datepicker>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" @click="save"><i class="fa fa-save"></i> {{__("Save changes")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script.body')
    @include('Layout::admin.components.datepicker')
    @include('Layout::admin.components.select2')
    @include('Order::admin.order.detail.components.modal-address')
    @include('Order::admin.order.detail.components.item')
    <script>
        BC.routes.customer = {
            getForSelect2:"{{route('customer.admin.getForSelect2',['need_address'=>1])}}"
        };
        BC.routes.product = {
            getForSelect2: "{!! route('product.admin.getForSelect2',['need_variations'=>1,'select2'=>1]) !!}"
        }
        var bc_order = {!! json_encode(new \Modules\Order\Resources\Admin\OrderResource($order)) !!}
        var bc_country_list = {!! json_encode(get_country_lists()) !!}
    </script>
    <script src="{{asset('module/order/admin/detail.js')}}"></script>
@endsection
