@php
    $shipping_session = [];
    $list_country = get_country_lists();
@endphp
<tr class="shipping-method">
    <td>{{__('Shipping')}}</td>
    <td colspan="2">
        <div v-for="item in shipping_methods">
            @{{ item.title }}
        </div>
        <div class="method float-end">
            <div class="form-check mb-1 mt-1" v-for="(item,index) in shipping_methods">
                <input class="form-check-input" type="radio" name="method_id" :id="index" :value="item.method_id">
                <label class="form-check-label" :for="index">
                    @{{ item.method_title }} <span v-if="item.method_cost > 0">@{{ formatMoney(item.method_cost) }}</span>
                </label>
            </div>
        </div>
        <p class="text text-end mb-0" > @{{ shipping_message }}</p>
    </td>
</tr>