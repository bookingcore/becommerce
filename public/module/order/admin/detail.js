new Vue({
    el:'#bc_order_form',
    data:{
        id:'',
        items:[],
        billing:{},
        shipping:{},
        customer:{
            id:'',
            display_name:'',
            billing:{},
            shipping:{}
        },
        custom_select2:{
            ajax:{
                'url' : BC.routes.customer.getForSelect2,
                'dataType': 'json'
            },
            allowClear  :true,
        },
        created_at_settings:{
            singleDatePicker: true,
            showCalendar: false,
            autoUpdateInput: false, //disable default date
            sameDate: true,
            autoApply           : true,
            disabledPast        : true,
            enableLoading       : true,
            showEventTooltip    : true,
            classNotAvailable   : ['disabled', 'off'],
            disableHightLight: true,
            showDropdowns : true,
            locale:{
                format:'YYYY/MM/DD HH:mm',
            },
            timePicker: true,
            timePicker24Hour: true,
        },
        order_date:'',
        address_keys:[
            'first_name',
            'last_name',
            'company',
            'address',
            'address2',
            'city',
            'state',
            'postcode',
            'country',
        ],
        countries:bc_country_list,
        saving:false,
        message:{
            success:true,
            content:''
        },
        shipping_amount:0,
        shipping_methods:{},
        shipping_method:'',
        prices_include_tax:'yes',
        tax_lists:[],
        is_editable:true
    },
    created:function (){
        for(var k in bc_order){
            this[k] = bc_order[k];
        }
        if(!this.order_date) this.order_date = moment().format('YYYY-MM-DD HH:mm:ss');
    },
    methods:{
        save:function (){
            if(this.saving) return;
            this.saving = true;
            var me = this;
            this.message = {
                content:''
            };
            $.ajax({
                url:BC.routes.order.store,
                data:{
                    customer_id:this.customer.id,
                    billing:this.billing,
                    shipping:this.shipping,
                    items:this.items.map(function(item){
                        return {
                            id:item.id,
                            product_id:item.product_id,
                            qty:item.qty,
                            variation_id:item.variation_id,
                        }
                    }),
                    status:this.status,
                    order_date:this.order_date,
                    shipping_method:this.shipping_method,
                    shipping_amount:this.shipping_amount,
                    tax_lists:this.tax_lists
                },
                dataType:'json',
                type:'POST',
                success:function(json){
                    console.log(json.url);
                    me.saving = false;
                    if(json.message){
                        me.message = {
                            content:json.message,
                            success: json.status
                        }
                    }
                    if(json.url){
                        window.location.href = json.url;
                    }
                    if(json.status){
                        me.is_editable = json.data.is_editable
                    }
                },
                error:function(e){
                    me.saving = false;
                    if(e.responseJSON){

                        for(var k in e.responseJSON.errors){

                            me.message = {
                                content: Object.keys(e.responseJSON.errors).map(function(item){
                                    return e.responseJSON.errors[item][0]
                                }).join('<br>'),
                                success: false
                            }
                        }
                    }else {
                        if (e.responseText) {
                            me.message = {
                                content: e.responseText,
                                success: false
                            }
                        }
                    }
                }
            })
        },
        editAddress:function (type){
            var tmp = Object.assign({},type == 'billing' ? this.billing : this.shipping);
            this.$refs.modalAddress.show(type,tmp);
        },
        selectCustomer:function (user){
            console.log(user);
            if(user.billing) this.billing = user.billing;
            if(user.shipping) this.shipping = user.shipping;
            this.customer.display_name = user.text;
            this.customer.id = user.id;
            this.email = user.email;
        },
        saveAddress:function(type,data){
            if(type === 'billing'){
                this.billing = data;
            }else{
                this.shipping = data;
            }
        },
        delItem:function (index){
            this.items.splice(index,1);
        },
        addItem:function(){
            this.items.push({
                qty:1,
                price:0
            })
        },
        formatMoney:function(f){
            return bc_format_money(f);
        },
        changeItem:function(key,data){
            console.log('change')
            this.$set(this.items,key,data);
        },
        reloadCustomerAddress:function(){
            this.billing = this.customer.billing;
            this.shipping = this.customer.shipping;
        }
    },
    computed:{
        _subtotal:function(){
            var t = 0;
            this.items.map(function(item){
                t += item.qty * item.price;
            })
            return t;
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
