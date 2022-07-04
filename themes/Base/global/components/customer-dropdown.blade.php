<script type="text/x-template" id="bc_customer_dropdown">
    <div class="bc-form--quick-search relative dropdown" v-click-outside="hideDropdown">
        <input class="form-control" ref="input" v-model="s" type="text" @click="openDropdown" @keyup="startSearch" :placeholder="placeholder">
        <i class="fa fa-spinner fa-spin fa-fw margin-bottom absolute" v-show="loading" style="top:7px;font-size: 24px;right: 5px"></i>
        <div class="dropdown-menu w-100" :class="show ? 'show' : ''" >
            <div class="dropdown-item" @click="add(item)" v-for="(item,index) in items" style="cursor: pointer" v-if="items && items.length">
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
            <div v-if="!loading && loaded && !items.length" class="dropdown-item"><span class="text-danger">@{{not_found}}</span></div>
        </div>
    </div>
</script>
<script>
    Vue.component('bc-customer-dropdown', {
        template: '#bc_customer_dropdown',
        data:function(){
            return {
                first_load:true,
                timeout:null,
                loading:false,
                loaded:false
            }
        },
        props:{
            placeholder: {
                type: String,
                default: '{{__('Search for customer')}}',
            },
            not_found: {
                type: String,
                default: '{{__('No customer found')}}',
            },
        },
        methods: {
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
            add:function (item){
                this.$emit('add',item)
                this.hideDropdown();
            }
        },
    });
</script>
