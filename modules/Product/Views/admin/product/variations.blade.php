@if($row->id)
    <div class="panel" id="product_variations" v-cloak>
        <div class="panel-title">
            <div class="d-flex justify-content-between">
                <strong>{{__('Variations')}}</strong>
                <div class="panel-actions">
                    <a href="#" @click="openEdit({},$event)" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{__("Add Variation")}}</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
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
    </script>
@endif