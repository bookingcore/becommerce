<script type="text/x-template" id="POS_order_items">
    <div class="flex-grow-1 overflow-auto">
        <table class="table bc-table bc-table--vendor">
            <thead>
            <tr>
                <th>{{__("No")}}</th>
                <th>{{__("ID")}}</th>
                <th>{{__("Name")}}</th>
                <th width="100px">{{__("Qty")}}</th>
                <th>{{__("Price")}}</th>
                <th>{{__("Subtotal")}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,index) in order.items">
                <td>@{{index + 1}}</td>
                <td>@{{item.id}}<span v-if="item.variant_id" >_@{{ item.variant_id }}</span>
                </td>
                <td>@{{item.title}}
                    <span v-if="item.variation" class="badge bg-primary">@{{ item.variation.term_name.join(', ') }}</span>
                </td>
                <td><input class="form-control h-auto" min="1" type="number" :value="item.qty" @change="updateQty($event,item.id)"></td>
                <td>@{{formatMoney(item.price)}}</td>
                <td>@{{formatMoney(item.price * item.qty)}}</td>
                <td><a href="#" class="text-danger" @click.prevent="deleteItem(index)"><i class="fa fa-close"></i></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</script>
<script>
    Vue.component('pos-order-items', {
        template: '#POS_order_items',
        data() {
            return {
                i18n:i18n
            }
        },
        props:{
            order:{
                type:Object,
                default:{
                    items:[]
                }
            }
        },
        created:function(){
        },
        methods: {
            formatMoney:function(f){
                return bc_format_money(f);
            },
            updateQty:function(event,product_id){
                this.$emit('update','qty',event.target.value,product_id)
            },
            deleteItem:function (index){
                var c = confirm(i18n.delete_cart_item_confirm);
                if(!c) return;

                this.$emit('delete',index)
            }
        }
    });
</script>
