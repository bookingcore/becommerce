Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            // here I check that click was outside the el and his children
            if (!(el == event.target || el.contains(event.target))) {
                // and if it did, call method provided in attribute value
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', el.clickOutsideEvent)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
    },
});
var POS_App = new Vue({
    el:'#pos_app',
    data:{
        defaultOrder:{
          items:[]
        },
        orders:[
          {
              items:[],
              title:'Order #1'
          }
        ],
        currentOrder:{
            items:[]
        },
        currentOrderIndex:0,
        shipping_amount:0,
        shipping_methods:{},
        shipping_method:'',
        prices_include_tax:'yes',
        tax_lists:[],
        isSubmit:false,
        errors:{}
    },
    methods:{
        addProduct:function (product){
            let q = {product_id:product.id};
            if(product.product_type === 'variable'){
                q.variation_id = product.variation.id;
            }

            let find = _.find(this.currentOrder.items,q)
            if(find){
                find.qty += 1;
            }else{
                let tmp = {};
                tmp.product_id = product.id;
                switch (product.product_type){
                    case "variable":
                        tmp.variation = product.variation;
                        tmp.variation_id = product.variation.id;
                        tmp.price = tmp.variation.price;
                        break;
                    default:
                        tmp.price = product.price;
                        break;

                }
                tmp.title = product.title;
                tmp.qty = 1;
                this.currentOrder.items.push(tmp)
            }
        },
        deleteProduct:function (index){
            this.currentOrder.items.splice(index,1);
        },
        addOrder:function (){
            let tmp  = Object.assign({},this.defaultOrder);
            tmp.title = 'Order #'+(this.orders.length + 1);
            this.orders.push(tmp)
            this.switchOrder(tmp,this.orders.length - 1)
        },
        switchOrder:function(order,index){
            this.currentOrder = order;
            this.currentOrderIndex = index;
        },
        updateItem:function (field,val,product_id){
            let find = _.find(this.currentOrder.items,{id:product_id})
            if(find){
                find[field] = val;
            }
        },
        bindHotKeys:function (){

        },
        submitOrder:function (){
            if(this.isSubmit) return;
            if(!this.validateOrder()){
                return;
            }
            this.isSubmit  = true;
            var tmp = Object.assign({},this.currentOrder);
            tmp.channel = 'pos';
            var me = this;

            var loading = BCToast.loading(i18n.saving_order);
            $.ajax({
                url:'/pos/order/store',
                type:'POST',
                data:tmp,
                success:function(json){
                    loading.hide();
                    me.isSubmit = false;
                    if(json.data){
                        BCToast.success(i18n.order_saved);
                    }
                    if(!json.status){
                        BCToast.error(json.message);
                    }
                },
                error:function(e){
                    console.log(e)
                    loading.hide();
                    me.isSubmit = false;
                    if(e.responseJSON){
                        BCToast.error(e.responseJSON.message);
                    }
                }
            })
        },
        validateOrder:function (){
            this.errors = {};
            var me = this;
            if(!this.currentOrder.customer || !this.currentOrder.customer.id){
                this.addError('customer_id',i18n.validation.customer.required);
            }
            if(Object.keys(this.errors).length){
                var html = Object.keys(this.errors).map(function(item){
                    return me.errors[item]
                })
                BCToast.error(html.join('<br>'));
                return false;
            }
            return true;
        },
        addError(key,msg){
            this.errors[key] = msg;
        },
        changeCustomer:function(customer){
            this.currentOrder.customer = customer;
            this.currentOrder.customer_id = customer.id
        },
        changeOrder:function (key,val){
            this.$set(this.currentOrder,key,val);
        }
    },
    created:function (){
        this.bindHotKeys();
    },
    computed:{
        _subtotal:function(){
            var t = 0;
            this.currentOrder.items.map(function(item){
                t += item.qty * item.price;
            })
            return t;
        },
        _discount_amount:{
            get:function(){
                return this.currentOrder.discount_amount;
            },
            set:function (val){
                this.currentOrder.discount_amount = val;
            }
        },
        _total:function(){
            return this._subtotal + this.shipping_amount + (this.prices_include_tax === 'no' ? this._tax_amount : 0);
        },
        _tax_amount:function(){
            var subtotal = this._subtotal + this.shipping_amount;
            var tax_percent = 0;
            var me = this;
            this.tax_lists.map(function(tax,index){
                if(tax.active){
                    tax_percent += tax.tax_rate;
                }
            })
            if(tax_percent){
                return subtotal * tax_percent/100;
            }
            return 0;
        }
    }
})
