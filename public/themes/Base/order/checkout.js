(function ($) {

    new Vue({
        el:'#bravo-checkout-page',
        data:{
            onSubmit:false,
            errors:{},
            message:{
                content:'',
                type:false
            },
            shipping_same_address:true,
            shipping_method_selected:false,
            onGetShippingMethod:false,
            shipping_methods:[],
            shipping_message:"",
        },
        created:function(){
            var me = this;
            this.$nextTick(function(){
                $(document).on("change","[name=shipping_same_address]",function(){
                    me.shipping_same_address = this.checked ? true : false;
                });
                $(document).on("change","[name=shipping_country]",function(){
                    me.getShippingMethod( $(this).val() );
                });
                $(document).on("change","[name=billing_country]",function(){
                    if(me.shipping_same_address){
                        me.getShippingMethod( $(this).val() );
                    }
                });
                $(document).on("change","[name=method_id]",function(){
                    me.shipping_method_selected = $(this).val();
                });
                $("[name=shipping_same_address]").trigger('change');
            });
        },
        watch:{
            shipping_same_address(){
                var me = this;
                if(me.shipping_same_address === true){
                    $("[name=billing_country]").trigger('change');
                }else{
                    $("[name=shipping_country]").trigger('change');
                }
            }
        },
        computed:{

        },
        mounted() {

        },
        methods:{
            getShippingMethod(country){
                var me = this;
                me.shipping_message = "";
                if(this.onGetShippingMethod) return false;
                me.onGetShippingMethod = true;
                $.ajax({
                    'url': BC.url+'/cart/get_shipping_method',
                    data:{
                        shipping_country: country
                    },
                    method:"post",
                    success:function (res) {
                        me.onGetShippingMethod = false;
                        if(res.message)
                        {
                            me.shipping_message = res.message;
                        }
                        if(res.shipping_methods){
                            me.shipping_methods = res.shipping_methods;
                        }
                    },
                    error:function (e) {
                        me.onSubmit = false;
                        if(e.responseJSON){
                            me.shipping_message = e.responseJSON.message ? e.responseJSON.message : '';
                        }else{
                            if(e.responseText){
                                me.shipping_message = e.responseText;
                            }
                        }
                    }
                })
            },
            doCheckout(){
                var me = this;

                if(this.onSubmit) return false;

                if(!this.validate()) return false;

                this.onSubmit = true;
                $.ajax({
                    url:BC.routes.checkout.process,
                    data:$('#bravo-checkout-page').find('input,textarea,select').serialize(),
                    method:"post",
                    success:function (res) {
                        $('#bravo-checkout-page').find('.input-error').html('');
                        if(!res.status && !res.url){
                            me.onSubmit = false;
                        }

                        if(res.elements){
                            for(var k in res.elements){
                                $(k).html(res.elements[k]);
                            }
                        }

                        if(res.message)
                        {
                            me.message.content = res.message;
                            me.message.type = res.status;
                        }

                        if(res.url){
                            window.location.href = res.url
                        }

                        if(res.errors && typeof res.errors == 'object')
                        {
                            var html = '';
                            for(var i in res.errors){
                                html += res.errors[i]+'<br>';
                                $('.input-error.'+i).html('<span class="text-danger input-error">'+res.errors[i][0]+'</span>');
                            }
                            me.message.content = html;
                        }

                    },
                    error:function (e) {
                        me.onSubmit = false;
                        if(e.responseJSON){
							me.message.content = e.responseJSON.message ? e.responseJSON.message : 'Can not booking';
							me.message.type = false;
                        }else{
                            if(e.responseText){
								me.message.content = e.responseText;
								me.message.type = false;
                            }
                        }


                    }
                })
            },
            formatMoney: function (m) {
                return window.bc_format_money(m);
            },
            validate(){
                return true;
            }
        }
    })


    //Shipping
    //billing_country
})(jQuery)
