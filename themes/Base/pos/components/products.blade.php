<script type="text/x-template" id="POS_products">
    <div class="pos-products pt-3">
        <div class="row">
            <div class="col-md-3 mb-3 c-pointer " v-for="(item,index) in items" @click="add(item)">
                <div class="border-1 border-e1e1e1 bg-white h-100">
                    <figure class="relative ">
                        <img :src="item.image_url">
                        <span class="absolute bottom-0 left-0 right-0 p-2 text-center c-white bg-dark-75">
                            <span v-if="item.product_type == 'simple'">@{{ formatMoney(item.price) }}</span>
                            <span v-else-if="item.product_type == 'variable' && item.variation">@{{ formatMoney(item.variation.price) }}</span>
                        </span>
                    </figure>
                    <div class="fs-16 p-2">@{{item.title}}
                        <span v-if="item.variation">- @{{ item.variation.term_name.join(', ') }}</span>
                    </div>
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
            formatMoney:function(f){
                return bc_format_money(f);
            },
            getLists:function (){
                var me = this;
                var filter = {
                    search_type:'join_variation'
                };
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
