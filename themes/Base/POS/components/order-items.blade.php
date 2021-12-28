<script type="text/x-template" id="POS_order_items">
    <div class="p-3">
        <table class="table ps-table ps-table--vendor">
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
                <td>@{{item.id}}</td>
                <td>@{{item.title}}</td>
                <td><input class="form-control p-3 h-auto" type="number" :value="item.qty" @change="updateQty($event,item.id)"></td>
                <td>@{{item.price}}</td>
                <td>@{{item.price * item.qty}}</td>
                <td><a href="#"><i class="icon-cross"></i></a></td>
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
            updateQty:function(event,product_id){
                this.$emit('update','qty',event.target.value,product_id)
            }
        }
    });
</script>
