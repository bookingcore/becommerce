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
