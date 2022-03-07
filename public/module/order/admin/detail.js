new Vue({
    el:'#bc_order_form',
    data:{
        id:'',
        items:[],
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
        }
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

        }
    }
})
