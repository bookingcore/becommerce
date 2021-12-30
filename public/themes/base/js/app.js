$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content'),
        'Accept':'application/json'
    }
});
// dropdown
$('.bc-dropdown .bc-dropdown-btn').on('click',function(){
    $(this).parent().closest('.bc-dropdown').toggleClass('show');
})
$('.bc-dropdown .bc-close').on('click',function(){
    $(this).parent().closest('.bc-dropdown').removeClass('show');
})
function ajax_error_to_string(e){
    if(typeof e.responseJSON !== 'undefined'){
        if(e.responseJSON.errors){
            var html = [];
            for(var k in e.responseJSON.errors){
                html.push(e.responseJSON.errors[k].join("<br/>"));
            }

            return html.join("<br/>");
        }

        if(e.responseJSON.message){
            return e.responseJSON.message;
        }
    }
}
$('.bravo-form-login').on('submit',function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize()
    $.ajax({
        'url': '/login',
        'data': data,
        'type': 'POST',
        beforeSend: function () {
            form.addClass('loading');
            form.find('.error').hide();
            form.find('.icon-loading').css("display", 'inline-block');
        },
        success: function (data) {
            form.removeClass('loading')
            form.find('.icon-loading').hide();
            if(typeof data =='undefined') return;
            if (data.error === true) {
                if (data.messages !== undefined) {
                    for(var item in data.messages) {
                        var msg = data.messages[item];
                        form.find('.error-'+item).show().text(msg[0]);
                    }
                }
                if (data.messages.message_error !== undefined) {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                }
            }
            if (typeof data.redirect !== 'undefined' && data.redirect) {
                window.location.href = data.redirect
            }
        },
        error:function (e){
            form.removeClass('loading')
            var html = ajax_error_to_string(e);
            if(html){
                form.find('.message-error').show().html('<div class="alert alert-danger"><p>' + html + '</p></div>');
            }
        }
    });
    return false;
})
window.bravo_handle_error_response = function(e){
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            break;
    }
};
// Cart
$(document).on('click','.bc_add_to_cart',function(e){
    e.preventDefault();
    $(this).addClass('loading');
    var me = $(this);
    console.log(
        $(this).data('product')
    )
    $.ajax({
        url:'/cart/addToCart',
        data:$(this).data('product'),
        type:'post',
        dataType:'json',
        success:function(json){
            me.removeClass('loading');
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.message){
                BcApp.showAjaxMessage(json);
            }

        },
        error:function(err){
            bravo_handle_error_response(err);
            me.removeClass('loading');
        }
    })
})
$(document).on('click','.bc_delete_cart_item',function(e){
    e.preventDefault();
    var c = confirm("Do you want to delete this cart item?");
    if(!c) return;
    var removeElement = $(this).data('remove');
    console.log(removeElement);
    var me = $(this);
    var id = $(this).data('id');
    $.ajax({
        url:'cart/remove_cart_item',
        data:{
            id:id
        },
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.reload){
                window.location.reload();
            }
            if(json.message){
                BcApp.showAjaxMessage(json);
            }

            if(typeof removeElement !='undefined'){
                me.closest(removeElement).remove();
            }

        },
        error:function(err){
            bravo_handle_error_response(err);
            console.log(err)
        }
    })
})

var BcApp ={
    showSuccess:function (configs){
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.success;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showError:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.warning;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showAjaxError:function (e) {
        var json = e.responseJSON;
        if(typeof json !='undefined'){
            if(typeof json.errors !='undefined'){
                var html = '';
                _.forEach(json.errors,function (val) {
                    html+=val+'<br>';
                });

                return this.showError(html);
            }
            if(json.message){
                return this.showError(json.message);
            }
        }
        if(e.responseText){
            return this.showError(e.responseText);
        }
    },
    showAjaxMessage:function (json) {
        if(json.message)
        {
            if(json.status){
                this.showSuccess(json);
            }else{
                this.showError(json);
            }
        }
    },
    showConfirm:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }
        args.buttons = {
            confirm: {
                label: '<i class="fa fa-check"></i> '+i18n.confirm,
            },
            cancel: {
                label: '<i class="fa fa-times"></i> '+i18n.cancel,
            }
        };
        args.centerVertical = true;
        bootbox.confirm(args);
    }
};

jQuery(function ($) {

    var onSubmitSubscribe = false;
    //Subscribe box
    $('.bravo-subscribe-form').submit(function (e) {
        e.preventDefault();

        if (onSubmitSubscribe) return;

        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }

                if (json.status) {
                    me.find('input[name=email]').val('');
                }

            },
            error: function (e) {
                console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if(ajax_error_to_string(e)){
                    me.find('.form-mess').html('<span class="text-danger">' + ajax_error_to_string(e) + '</span>');
                }else
                if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });

});