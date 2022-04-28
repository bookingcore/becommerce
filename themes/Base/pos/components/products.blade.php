<script type="text/x-template" id="POS_products">
    <div class="pos-products ">
        <div class="row">
            <div class="col-md-3" v-for="(item,index) in items" @click="add(item)">
                <div class="pt-3 pb-3 c-pointer">
                    <figure class="relative bg-white  border-1 border-e1e1e1">
                        <img :src="item.image_url">
                        <span class="absolute bottom-0 left-0 right-0 p-2 text-center c-white bg-dark-75">@{{item.price_html}}</span>
                    </figure>
                    <div class="fs-16 mt-2">@{{item.title}}</div>
                </div>
            </div>
        </div>
    </div>
</script>
<script>
    Vue.component('pos-products', {
        template: '#POS_products',
        data() {
            return {
                items:[]
            }
        },
        created:function(){
            this.getLists();
        },
        methods: {
            getLists:function (){
                var me = this;
                var filter = {};
                $.ajax({
                    url:'/api/v1/product',
                    data:filter,
                    success:function (json){
                        if(json.data){
                            me.items = json.data;
                        }
                    }
                })
            },
            add:function (product){
                this.$emit('add',product)
            }
        }
    });
</script>
