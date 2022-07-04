<script type="text/x-template" id="POS_order_customer">
    <div :class="wrapClass">
        <div class="d-flex" v-if="!customer.id">
            <label class="me-2" >{{__("Customer")}}</label>
            <bc-customer-dropdown @change="change"/>
        </div>
        <div class="d-flex py-1 align-items-center" v-if="customer.id">
            <img class="me-2 rounded-circle" v-if="customer.avatar_url" width="30px" :src="customer.avatar_url">
            <div>
                <div>@{{customer.display_name}} - #@{{customer.id}}</div>
                <a href="#">@{{customer.email}}</a>
            </div>
        </div>
    </div>
</script>
<script>
    Vue.component('pos-order-customer', {
        template: '#POS_order_customer',
        data() {
            return {
                i18n:i18n,
                customer:{},
            }
        },
        props:{
            order:{
                type:Object,
                default:{
                }
            },
            wrapClass:{
                type:String,
                default:''
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
            },
            change:function (customer){
                this.customer = customer;
            }
        }
    });
</script>
