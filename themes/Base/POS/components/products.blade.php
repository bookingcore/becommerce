<script type="text/x-template" id="POS_products">
    <div class="pos-products">
        <div class="row">
            <div class="col-md-3" v-for="(item,index) in items" @click="add(item)">
                <figure>
                    <img :src="item.image_url">
                    <span class="absolute bottom-left bottom-right">@{{item.price_html}}</span>
                </figure>
                <h3>@{{item.title}}</h3>
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
                    url:'/api/product',
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
