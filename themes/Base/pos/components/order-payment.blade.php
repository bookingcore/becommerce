<script type="text/x-template" id="POS_payment">
    <div class="pos-payment flex-shrink-0 py-2" v-show="_total">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between mb-2">
                    <label >{{__("Subtotal")}}</label>
                    <div>@{{formatMoney(_subtotal)}}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label >{{__("Discount")}}</label>
                    <div><input type="number" class="form-control" step="any" min="0" v-model.number="_discount_amount"></div>
                </div>
                @if(\Modules\Product\Models\TaxRate::isEnable())
                    <div class="d-flex justify-content-between">
                        <div >
                            {{__("Tax")}} ({{\Modules\Product\Models\TaxRate::isPriceInclude() ? __("Include") : __("Exclude")}})
                        </div>
                        <div >@{{ formatMoney(_tax_amount) }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label v-for="(tax,index) in tax_lists">
                            <input type="checkbox" v-model="tax_lists[index]['active']" :value="index"> @{{ tax.name }} @{{tax.tax_rate}}%
                        </label>
                    </div>
                @endif
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <label class="fw-bold">{{__("Total")}}</label>
                    <div class="fw-bold">@{{formatMoney(_total)}}</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between mt-2">
            <div></div>
            <div>
                <a href="#" class="btn btn-lg btn-success" @click.prevent="submitOrder">{{__('Pay: ')}} @{{ formatMoney(_total) }} {{__("(F9)")}}</a>
            </div>
        </div>
    </div>
</script>
<script>
    Vue.component('pos-payment', {
        template: '#POS_payment',
        data() {
            return {
                items:[],
                shipping_methods:{!! json_encode((new \Modules\Product\Models\ShippingZoneMethod())->methods()) !!},
                tax_lists:{!! json_encode(\Modules\Product\Models\TaxRate::select("id","name", "tax_rate", "city", "postcode", "country", "state")->get()) !!},
                prices_include_tax:'{{setting_item('prices_include_tax','')}}'
            }
        },
        props:{
            order:{
                type:Object,
                default:{}
            },
        },
        methods:{
            formatMoney:function(f){
                return bc_format_money(f);
            },
            submitOrder:function (){
                this.$emit('submit')
            },
            changeDiscount:function (e){
                //this.$emit('change-discount')
            }
        },
        created:function (){
            var me = this;
            document.addEventListener("keydown", function(e){
                if(e.code === 'F9'){
                    e.preventDefault();
                    me.submitOrder();
                }
            }, false);

        },
        computed:{
            _subtotal:function(){
                var t = 0;
                this.order.items.map(function(item){
                    t += item.qty * item.price;
                })
                return t;
            },
            _discount_amount:{
                get:function(){
                    return this.order.discount_amount ?? 0;
                },
                set:function (val){
                    this.order.discount_amount = val;
                }
            },
            _shipping_amount:{
                get:function(){
                    return this.order.shipping_amount ?? 0;
                },
                set:function (val){
                    this.order.shipping_amount = val;
                }
            },
            _total:function(){
                let t = this._subtotal + this._shipping_amount - this._discount_amount + (this.prices_include_tax === 'no' ? this._tax_amount : 0);
                if(t <= 0) return 0;
                return t;
            },
            _tax_amount:function(){
                var subtotal = this._subtotal + this._shipping_amount - this._discount_amount;
                if(subtotal <= 0){
                    return 0;
                }
                var tax_percent = 0;
                var me = this;
                this.tax_lists.map(function(tax,index){
                    if(tax.active){
                        tax_percent += tax.tax_rate;
                    }
                })
                if(tax_percent){
                    return subtotal * tax_percent/100;
                }
                return 0;
            }
        }
    })
</script>
