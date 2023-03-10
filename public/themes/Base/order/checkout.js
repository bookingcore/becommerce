(function ($) {

    new Vue({
        el:'#bravo-checkout-page',
        data:{
            id:'',
            onSubmit:false,
            errors:{},
            message:{
                content:'',
                type:false
            },
            //Shipping
            shipping_country:'',
            billing_country:'',
            shipping_same_address:true,
            shipping_method_selected:false,
            onGetShippingMethod:false,
            shipping_methods:[],
            shipping_message:"",
            subtotal_amount:0,
            shipping_available:false,
            //Tax
            tax_available:false,
            prices_include_tax:'no',
            tax_amount:'',
            tax:false,
            onGetTaxRate:false,
            discount_amount:0
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
                    me.shipping_country = $(this).val();
                    me.getShippingMethod( );
                    me.getTaxRate();
                });
                $(document).on("change","[name=billing_country]",function(){
                    me.billing_country = $(this).val();
                    if(me.shipping_same_address){
                        me.shipping_country = me.billing_country;
                        me.getShippingMethod();
                    }
                    me.getTaxRate();
                });
                $(document).on("change","[name=shipping_method_id]",function(){
                    me.shipping_method_selected = $(this).val();
                });
                me.shipping_same_address = $("[name=shipping_same_address]").is(":checked") ? true : false;
                if(me.shipping_same_address === true){
                    $("[name=billing_country]").trigger('change');
                }else{
                    $("[name=shipping_country]").trigger('change');
                }
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
                if(me.tax !== false){
                    var tax_rate = 0;
                    var tax_amount = 0;
                    for (var ix in me.tax){
                        var item = me.tax[ix];
                        tax_rate += parseFloat(item.tax_rate);
                    }
                    tax_amount = ( total_amount / 100 ) * tax_rate;
                    me.tax_amount = tax_amount;
                    if(me.prices_include_tax == "no"){
                        total_amount += tax_amount;
                    }
                }
                if(total_amount < 0){
                    total_amount = 0;
                }
                return total_amount;
            },
            total_amount_html:function(){
                if(!this.total_amount) return '0';
                return window.bc_format_money(this.total_amount);
            },
            discount_amount_html:function(){
                if(!this.discount_amount) return '';
                return window.bc_format_money(this.discount_amount);
            },
            tax_amount_html:function(){
                if(!this.tax_amount) return '';
                return window.bc_format_money(this.tax_amount);
            },
        },
        mounted() {

        },
        methods:{
            getUrl(path){
                var url = BC.url;
                if(BC.is_api){
                    url += '/api/v1';
                }
                url += path;
                return url;
            },
            getShippingMethod(){
                var me = this;
                me.shipping_message = "";
                if(this.onGetShippingMethod) return false;
                if(!me.shipping_available) return false;
                me.onGetShippingMethod = true;
                $.ajax({
                    'url': this.getUrl('/cart/get_shipping_method'),
                    data:{
                        country: me.shipping_country,
                        cart_id:me.id
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
                        me.onGetShippingMethod = false;
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
            getTaxRate(){
                var me = this;
                me.shipping_message = "";
                if(this.onGetTaxRate) return false;
                if(!me.tax_available) return false;
                me.onGetTaxRate = true;
                $.ajax({
                    'url': this.getUrl('/cart/get_tax_rate'),
                    data:{
                        billing_country: me.billing_country,
                        shipping_country: me.shipping_country,
                        cart_id:me.id
                    },
                    method:"post",
                    success:function (res) {
                        me.onGetTaxRate = false;
                        if(res.message)
                        {
                            me.shipping_message = res.message;
                        }
                        if(res.tax){
                            me.tax = res.tax;
                        }
                        if(res.prices_include_tax){
                            me.prices_include_tax = res.prices_include_tax;
                        }
                    },
                    error:function (e) {
                        me.onGetTaxRate = false;
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
