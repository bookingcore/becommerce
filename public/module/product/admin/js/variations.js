new Vue({
    el:'#product_variations',
    data:{
        ids:[],
        rows:[],
        currentRow:{},
        variationFormSchema:variationFormSchema,
        product_id:product_id
    },
    methods:{
        openEdit:function(row){
            this.currentRow = row;
            $('#variation_form_modal').modal('show');
        },
        reload:function () {
            $.ajax({
                url:bookingCore.url+'/admin.product'
            })
        }
    },
    created:function () {
        this.$nextTick(function () {
            $('#variation_form_modal').modal({
                show:false,
                backdrop:'static'
            })
        })
    }
});