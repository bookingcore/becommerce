<script type="text/x-template" id="POS_products">
    <div class="pos-products">
        <div class="h5 mb-3">{{__("Found")}} @{{ api_res.meta.total }} {{__("product(s)")}}</div>
        <div class="row mb-3">
            <div class="col-md-3">
                <select v-model="cat_id" class="form-select" @change="getLists(1)">
                    <option value="">{{__("All Categories")}}</option>
                    <option v-for="(item,index) in categories" :value="item.id">@{{item.name}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3" v-for="(item,index) in items" >
                <div class="border-1 border-e1e1e1 bg-white h-100  c-pointer " @click="add(item)">
                    <figure class="relative mb-0">
                        <img :src="item.image_url" class="img-fluid">
                        <span class="absolute bottom-0 left-0 right-0 p-2 text-center c-white bg-dark-75">
                            <span v-if="item.product_type == 'simple'">@{{ formatMoney(item.price) }}</span>
                            <span v-else-if="item.product_type == 'variable' && item.variation">@{{ formatMoney(item.variation.price) }}</span>
                        </span>
                    </figure>
                    <div class="fs-16 p-2">@{{item.title}}
                        <span v-if="item.variation" class="badge bg-primary">@{{ item.variation.term_name.join(', ') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <bc-pagination :data="api_res" @change="getLists"></bc-pagination>
    </div>
</script>
<script>
    Vue.component('pos-products', {
        template: '#POS_products',
        data() {
            return {
                items:[],
                api_res:{
                    meta:{}
                },
                filter:{

                },
                categories:[],
                cat_id:''
            }
        },
        created:function(){
            this.getLists();
            this.loadCategories();
        },
        methods: {
            formatMoney:function(f){
                return bc_format_money(f);
            },
            getLists:function (page){
                if(typeof page == "undefined") page = 1;
                var me = this;
                var filter = {
                    search_type:'join_variation',
                    limit:100,
                    page:page,
                    type_not_in:['grouped','external'],
                    category_id:this.cat_id
                };
                $.ajax({
                    url:'/api/v1/product',
                    data:filter,
                    success:function (json){
                        if(json.data){
                            me.items = json.data;
                        }
                        me.api_res = json;
                    }
                })
            },
            add:function (product){
                this.$emit('add',product)
            },
            loadCategories:function (){
                var me = this;
                $.ajax({
                    url:'/api/v1/category',
                    success:function (json){
                        if(json.data){
                            me.categories = json.data;
                        }
                    }
                })
            }
        }
    });
</script>
