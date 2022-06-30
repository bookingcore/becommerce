<script type="text/x-template" id="POS_header_search">
    <div class="bc-form--quick-search relative dropdown" v-click-outside="hideDropdown">
        <input class="form-control" v-model="s" type="text" @click="openDropdown" @keyup="startSearch" placeholder="{{__("Search products (F3)")}}">
        <i class="fa fa-spinner fa-spin fa-fw margin-bottom absolute" v-show="loading" style="top:7px;font-size: 24px;right: 5px"></i>
        <div class="dropdown-menu w-100" :class="show ? 'show' : ''" >
            <div class="dropdown-item" @click="addProduct(item)" v-for="(item,index) in items" style="cursor: pointer" v-if="items && items.length">
                <div class="row">
                    <div class="col-md-1">
                        #@{{ item.id }}<span v-if="item.variation">_@{{ item.variation.id }}</span>
                    </div>
                    <div class="col-md-1">
                        <img v-if="item.image_url" width="30px" :src="item.image_url">
                    </div>
                    <div class="col-md-7">@{{ item.title }}
                        <span v-if="item.variation" class="badge bg-primary">@{{ item.variation.term_name.join(', ') }}</span>
                    </div>
                    <div class="col-md-3 text-right text-end">
                        <span v-if="item.product_type == 'simple'">@{{ formatMoney(item.price) }}</span>
                        <span v-else-if="item.product_type == 'variable' && item.variation">@{{ formatMoney(item.variation.price) }}</span>
                    </div>
                </div>
            </div>
            <div v-if="!loading && loaded && !items.length" class="dropdown-item"><span class="text-danger">{{__("No product found")}}</span></div>
        </div>
    </div>
</script>
<script>
    Vue.component('pos-header-search', {
        template: '#POS_header_search',
        data() {
            return {
                s:[],
                show:false,
                items:[],
                api_res:{},
                first_load:true,
                timeout:null,
                loading:false,
                loaded:false
            }
        },
        methods: {
            formatMoney:function(f){
                return bc_format_money(f);
            },
            search:function (){
                var me = this;
                this.loading = true;
                var filter = {
                    s:this.s,
                    type_not_in:['grouped','external'],
                    search_type:'join_variation',
                    limit:10
                }
                $.ajax({
                    url:'/api/v1/product',
                    data:filter,
                    success:function (json){
                        if(json.data){
                            me.items = json.data;
                        }
                        me.api_res = json;
                        me.loading = false;
                        me.loaded = true;
                    },
                    error:function (e){
                        me.loading = false;
                        me.loaded = true;
                    }
                })
            },
            openDropdown:function (){
                var me = this;
                me.show = true;
                if(!me.first_load) return;
                me.first_load = false;

                this.search();
            },
            startSearch:function (){
                var me = this;
                if(this.timeout) window.clearTimeout(this.timeout);

                this.timeout = window.setTimeout(function(){
                    me.search();
                },300);
            },
            hideDropdown:function (e){
                this.show = false;
            },
            addProduct:function (item){
                this.$emit('add',item)
                this.hideDropdown();
            }
        }
    })
</script>
