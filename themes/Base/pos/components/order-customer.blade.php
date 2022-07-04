<script type="text/x-template" id="POS_order_customer">
    <div>
        <label >{{__("Customer")}}</label>
        <bc-customer-dropdown/>
    </div>
</script>
<script>
    Vue.component('pos-order-customer', {
        template: '#POS_order_customer',
        data() {
            return {
                i18n:i18n,
                customer:{}
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
