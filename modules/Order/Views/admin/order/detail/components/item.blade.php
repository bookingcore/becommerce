<script type="text/x-template" id="bc-order-item-template">
    <div class="item" data-number="1">
        <div class="row">
            <div class="col-md-4">
                <bc-select2 placeholder="{{__('-- Select Product --')}}" :settings="product_settings" v-model="item.product_id" @select="productChange"/>
            </div>
            <div class="col-md-2">
                <select class="form-control" v-show="product.product_type == 'variable'" v-model="item.variation_id" @change="variationChange">
                    <option v-for="v in variations" :value="v.id">@{{ v.name }}</option>
                </select>
            </div>
            <div class="col-md-1">
                <input type="number" min="1" step="1" class="form-control" v-model="item.qty">
            </div>
            <div class="col-md-2">
                <input type="number" min="0" step="any" class="form-control" v-model="item.price">
            </div>
            <div class="col-md-2 text-right">
                @{{ formatMoney(subtotal) }}
            </div>
            <div class="col-md-1">
                <span class="btn btn-danger btn-sm" @click="del"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    Vue.component('bc-order-item', {
        template:'#bc-order-item-template',
        data() {
            return {
                select2: null,
                item:{
                    id:'',
                    price:0,
                    qty:1,
                    variation_id:0,
                    product_id:0
                },
                type:'billing',
                countries:[],
                active:0,
                product_settings:{
                    width:'100%',
                    allowClear  :true,
                    ajax:{
                        'url' : BC.routes.product.getForSelect2,
                        'dataType': 'json',
                        processResults: function (data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data.data
                            };
                        }
                    }
                },
                index:'',
                product:{
                    type:''
                },
                variations:[]
            };
        },
        props: {
        },
        watch: {
        },
        computed:{
            subtotal:function(){
                return this.item.qty * this.item.price;
            }
        },
        methods: {
            formatMoney:function(f){
                return bc_format_money(f)
            },
            del:function(){
                this.$emit('del',this.index)
            },
            save:function(e){
                e.preventDefault();
                this.$emit('save',this.type,Object.assign({},this.fields));
                this.hide();
            },
            show(type,fields){
                $('#modal-address').modal('show');
                this.type = type;
                this.fields = fields;
            },
            hide(){
                $('#modal-address').modal('hide');
            },
            productChange:function (data) {
                this.product = data;
                this.item.product_id = data.id;
                this.variations = this.product.variations ?? [];
                if(data.product_type == 'simple'){
                    this.item.price = data.price;
                }
            },
            variationChange:function (variation_id) {
                var find = _.find(this.variations,{id:variation_id});
                if(find){
                    this.item.price = find.price;
                }
            }
        },
        mounted() {
            var me = this;
            var tmp = [];
            for(var k in bc_country_list){
                tmp.push({
                    id:k,
                    text:bc_country_list[k]
                })
            }
            this.countries = tmp;
            this.$nextTick(function(){
                $('#modal-address').on('hide.bs.modal',function(){
                    me.active = 0
                })
            })
        },
        beforeDestroy() {
        }
    });
</script>
