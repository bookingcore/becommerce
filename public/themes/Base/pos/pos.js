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
        currentOrderIndex:0
    },
    methods:{
        addProduct:function (product){
            let find = _.find(this.currentOrder.items,{id:product.id})
            if(find){
                find.qty += 1;
            }else{
                let tmp = {};
                tmp.id = product.id;
                tmp.title = product.title;
                tmp.price = product.price;
                tmp.qty = 1;
                this.currentOrder.items.push(tmp)
            }
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
        }
    }
})
