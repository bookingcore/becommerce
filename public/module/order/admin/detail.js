new Vue({
    el:'#bc_order_form',
    data:{
        id:'',
        items:[],
        billing:{},
        shipping:{},
        customer:{
            id:'',
            display_name:''
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
        created_at:'',
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
        countries:bc_country_list
    },
    created:function (){
        for(var k in bc_order){
            this[k] = bc_order[k];
        }
    },
    methods:{
        save:function (){

        },
        editAddress:function (type){
            var tmp = Object.assign({},type == 'billing' ? this.billing : this.shipping);
            this.$refs.modalAddress.show(type,tmp);
        },
        selectCustomer:function (user){
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
        }
    },
    computed:{
        subtotal:function(){
            return 0
        },
        total:function(){
            return 0;
        }
    }
})
