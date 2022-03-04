(function ($) {

    new Vue({
        el:'#bravo-checkout-page',
        data:{
            onSubmit:false,
            message:{
                content:'',
                type:false
            },
            shipping_same_address:1,
            errors:{}
        },
        methods:{
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
                        $('#bravo-checkout-page').find('.input-error').remove();
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
                                $('[name='+i+']').after('<span class="text-danger input-error">'+res.errors[i][0]+'</span>');
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
            validate(){
                return true;
            }
        }
    })

})(jQuery)
