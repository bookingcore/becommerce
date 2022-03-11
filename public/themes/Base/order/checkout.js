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
            subtotal_amount:0,
        },
        created:function(){
            for(var k in bc_order_data){
                this[k] = bc_order_data[k];
            }
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
                $(document).on("change","[name=shipping_method_id]",function(){
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
            total_amount:function(){
                var me = this;
                var total_amount = me.subtotal_amount;
                //Shipping
                if(me.shipping_method_selected !== false){
                    for (var ix in me.shipping_methods){
                        var item = me.shipping_methods[ix];
                        if(item.method_id == me.shipping_method_selected){
                            total_amount +=  parseFloat(item.method_cost);
                        }
                    }
                }
                //Tax
                //Discount
                if(me.discount_amount > 0){
                    total_amount -=  me.discount_amount;
                }
                return total_amount;
            },
            total_amount_html:function(){
                if(!this.total_amount) return '';
                return window.bc_format_money(this.total_amount);
            },
            discount_amount_html:function(){
                if(!this.discount_amount) return '';
                return window.bc_format_money(this.discount_amount);
            },
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
                    data:$('#bravo-checkout-page').find('input,textarea,select,radio').serialize(),
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
