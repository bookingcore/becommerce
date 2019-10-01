import Vue from 'vue';
import VueFormGenerator from 'vue-form-generator';
require('../../template/admin/custom-fields')
export default function() {
    new Vue({
        el:'#product_variations',
        data:{
            ids:[],
            rows:[],
            currentRow:{},
            variationFormSchema:variationFormSchema,
            product_id:product_id,
            options:{},
            variationRoutes:variationRoutes,
            onSavingVariation:false,
            lastVariationResponse:{},
            attributes:[],
            attributes_for_variation:{},
        },
        methods:{
            openEdit:function(row,e){
                if(e){
                    e.preventDefault();
                }
                this.currentRow = Object.assign({},row);
                $('#variation_form_modal').modal('show');
            },
            reload:function () {

                var me = this;

                $.ajax({
                    url:variationRoutes.load,
                    type:'get',
                    data:{
                        product_id:product_id
                    },
                    success:function (json) {
                        if(json.status){
                            me.rows = json.rows;
                        }
                    }
                });
            },
            saveVariation:function(){

                if(this.onSavingVariation) return;
                this.onSavingVariation = true;
                var me  = this;
                var tmp = Object.assign({},this.currentRow);
                tmp.product_id = this.product_id;
                me.lastVariationResponse = {};

                $.ajax({
                    url:variationRoutes.store,
                    type:'post',
                    data:tmp,
                    success:function (json) {
                        me.onSavingVariation = false;
                        if(json.status){
                            me.reload();
                        }
                        me.lastVariationResponse = json;
                    },
                    error:function (e) {
                        me.onSavingVariation = false;
                    }
                })
            }
        },
        created:function () {
            var me = this;
            this.$nextTick(function () {
                $('#variation_form_modal').modal({
                    show:false,
                    backdrop:'static'
                });
            });
            if(typeof productJsData !='undefined')
            {
                _.forEach(productJsData,function (v,k) {
                    me.$set(k,me,v);
                })
            }
        },
        components: {
            "vue-form-generator": VueFormGenerator.component,
        },
    });
}