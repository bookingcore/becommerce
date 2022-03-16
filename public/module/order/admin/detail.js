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
    },
    created:function (){
        for(var k in bc_order){
            this[k] = bc_order[k];
        }
        if(!this.order_date) this.order_date = moment();
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
                    items:this.items,
                    status:this.status,
                    order_date:this.order_date,
                    shipping_method:this.shipping_method,
                    shipping_amount:this.shipping_amount,
                },
                dataType:'json',
                type:'POST',
                success:function(json){
                    me.saving = false;
                    if(json.message){
                        me.message = {
                            content:json.message,
                            success: json.status
                        }
                    }
                    if(json.url){
                        window.location.url = json.url;
                    }
                },
                error:function(e){
                    me.saving = false;
                    if(e.responseText){
                        me.message = {
                            content:e.responseText,
                            success: false
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
        subtotal:function(){
            var t = 0;
            this.items.map(function(item){
                t += item.qty * item.price;
            })
            return t;
        },
        total:function(){
            return this.subtotal + this.shipping_amount;
        }
    }
})
