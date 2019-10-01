@if($row->id)
    <div class="panel" id="product_variations" v-cloak>
        <div class="panel-title">
            <div class="d-flex justify-content-between">
                <strong>{{__('Variation Management')}}</strong>
            </div>
        </div>
        <div class="panel-body">
            <label class="group-title"><strong>{{__("Attributes")}}</strong></label>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" >
                            </th>
                            <th>
                                {{__('Attribute')}}
                            </th>
                            <th> {{__('Values')}} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(s,index) in attributes_for_variation">
                            <td>
                                <select  class="custom-select" v-model="attributes_for_variation[index]">
                                    <option value="">{{__('-- Please Select --')}}</option>
                                    <option :disabled="attributes_for_variation.indexOf(attr.id) <0 && s != attr.id" v-for="attr in attributes" :value="attr.id">@{{attr.name}}</option>
                                </select>
                            </td>
                            <td>
                                <div class="variation-desc">@{{row.desc}}</div>
                            </td>
                            <td><a href="#" @click="openEdit(row)" class="btn btn-sm btn-info">{{__('edit')}}</a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-sm btn-add-attribute"><i class="fa fa-plus"></i> {{__('Add Attribute')}} </button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
            <label class="group-title"><strong>{{__("Variations")}}</strong></label>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" >
                            </th>
                            <th>
                                {{__('Name')}}
                            </th>
                            <th> {{__('Price')}} </th>
                            <th> {{__('Quantity')}} </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows">
                            <td><input type="checkbox" v-model="ids" :value="row.id"></td>
                            <td>
                                @{{row.name}}
                                <div class="variation-desc">@{{row.desc}}</div>
                            </td>
                            <td>@{{row.price_html}}</td>
                            <td>@{{row.quantity }}</td>
                            <td><a href="#" @click="openEdit(row)" class="btn btn-sm btn-info">{{__('edit')}}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @include('Product::admin.product.variation-form-vue')
    </div>

    <script>
        var variationFormSchema  = {!! json_encode($row->variation_form_schema) !!};
        var product_id = {{$row->id}}
        var variationRoutes = {
                'load':'{{route('product.admin.variation.load')}}',
                'store':'{{route('product.admin.variation.store')}}',
            };
        var productJsData = {!! json_encode($row->product_js_admin_data) !!};
    </script>
@endif