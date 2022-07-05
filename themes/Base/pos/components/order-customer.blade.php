<script type="text/x-template" id="POS_order_customer">
    <div :class="wrapClass">
        <div class="d-flex relative" v-if="!customer.id">
            <bc-customer-dropdown :class="'w-100'" @change="change"/>
        </div>
        <div class="d-flex justify-content-between border rounded align-items-center " v-if="customer.id">
            <div class="flex-grow  d-flex align-items-center p-1"  >
                <img class="me-2 rounded-circle" v-if="customer.avatar_url" width="30px" :src="customer.avatar_url">
                <div>
                    <div>@{{customer.display_name}} - #@{{customer.id}}</div>
                    <a href="#">@{{customer.email}}</a>
                </div>
            </div>
            <div class="flex-shrink-0 border-start h-100">
                <a href="#" class="d-block p-2 h-100" @click.prevent="customer.id = null">
                    <i class="fa fa-edit" style="font-size: 26px"  ></i>
                </a>
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
                this.$emit('change-customer',customer);
            }
        }
    });
</script>
