<script type="text/x-template" id="bc-order-item-template">
    <div class="item" data-number="1">
        <div class="row">
            <div class="col-md-5">
                <select class="form-control"></select>
            </div>
            <div class="col-md-2">
                <input type="number" min="1" step="1" class="form-control" v-model="item.qty">
            </div>
            <div class="col-md-2">
                <input type="number" min="0" step="any" class="form-control" v-model="item.price">
            </div>
            <div class="col-md-2">
                @{{ formatMoney(subtotal) }}
            </div>
            <div class="col-md-1">
                <span class="btn btn-danger btn-sm" @click="del"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('bc-order-item', {
        template:'#bc-order-item-template',
        data() {
            return {
                select2: null,
                item:{
                    id:'',
                    price:0,
                    qty:1
                },
                type:'billing',
                countries:[],
                active:0,
                country_settings:{
                    width:'100%',
                    allowClear  :true,
                },
                index:''
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
