$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content')
    }
});
// dropdown
$('.bc-dropdown .bc-dropdown-btn').on('click',function(){
    $(this).parent().closest('.bc-dropdown').toggleClass('show');
})
$('.bc-dropdown .bc-close').on('click',function(){
    $(this).parent().closest('.bc-dropdown').removeClass('show');
})
$('.bravo-form-login').on('submit',function (e) {
    console.log(2222)
    e.preventDefault();
    var form = $(this);
    var data = form.serialize()
    $.ajax({
        'url': '/login',
        'data': data,
        'type': 'POST',
        beforeSend: function () {
            form.find('.error').hide();
            form.find('.icon-loading').css("display", 'inline-block');
        },
        success: function (data) {
            form.find('.icon-loading').hide();
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
            if (data.redirect !== undefined && data.redirect) {
                window.location.href = data.redirect
            }
        }
    });
    return false;
})
